<?php
/*
  Plugin Name: wpDiscuz - myCRED Integration
  Description: Integrates myCRED Badges and Ranks. Converts wpDiscuz comment votes/likes to myCRED points.
  Version: 7.0.3
  Author: gVectors Team
  Plugin URI: https://gvectors.com/product/wpdiscuz-mycred/
  Author URI: https://gvectors.com/product/wpdiscuz-mycred/
  Text Domain: wpdiscuz-mc
  Domain Path: /languages/
 */
define("WMI_DIR_PATH", dirname(__FILE__));
require_once WMI_DIR_PATH . "/includes/gvt-api-manager.php";
$wpdiscuzMycredIntegrationApi = null;
add_action("plugins_loaded", function () {
    if (function_exists("wpDiscuz")) {
        global $wpdiscuzMycredIntegrationApi;

        $wpdiscuzMycredIntegrationApi = new GVT_API_Manager(__FILE__, "wpdiscuz_options_page", "wpdiscuz_option_page");

        add_filter("mycred_setup_hooks", "register_wpdiscuz_vote_hook_in_mycred");
        add_filter("mycred_all_references", "add_wpDiscuz_in_references");
        add_action("admin_enqueue_scripts", "wpdiscuzMcAdminStyles", 2319);
        load_plugin_textdomain("wpdiscuz-mc", false, dirname(plugin_basename(__FILE__)) . "/languages/");

        add_filter("mycred_parse_log_entry_wpdiscuz_vote_user", "wpdiscuz_mycred_parse_log_entry", 10, 2);
        add_filter("mycred_parse_log_entry_wpdiscuz_up_vote_cauthor", "wpdiscuz_mycred_parse_log_entry", 10, 2);
        add_filter("mycred_parse_log_entry_wpdiscuz_down_vote_cauthor", "wpdiscuz_mycred_parse_log_entry", 10, 2);

        function wpdiscuz_mycred_parse_log_entry($content, $log_entry) {
            if ($log_entry->ref_id === NULL)
                return $content;

            $comment = get_comment($log_entry->ref_id);
            if ($comment === NULL) {
                $data = maybe_unserialize($log_entry->data);
                if (!is_array($data) || !array_key_exists("comment_ID", $data))
                    return $content;
                $comment = new StdClass();
                foreach ($data as $key => $value) {
                    $comment->$key = $value;
                }
                $url = get_permalink($comment->comment_post_ID);
                if (empty($url))
                    $url = "#item-has-been-deleted";

                $title = get_the_title($comment->comment_post_ID);
                if (empty($title))
                    $title = __("Deleted Item", "mycred");
            }
            else {

                $url = get_permalink($comment->comment_post_ID);
                $title = get_the_title($comment->comment_post_ID);
            }

            $content = str_replace("%comment_id%", $comment->comment_ID, $content);
            $content = str_replace("%c_post_id%", $comment->comment_post_ID, $content);
            $content = str_replace("%c_post_title%", $title, $content);
            $content = str_replace("%c_post_url%", $url, $content);
            $content = str_replace("%c_link_with_title%", "<a href='" . $url . "'>" . $title . "</a>", $content);

            return $content;
        }

        function register_wpdiscuz_vote_hook_in_mycred($installed) {

            $installed["wpdiscuz_vote"] = [
                "title" => __("wpDiscuz Integration", "wpdiscuz-mc"),
                "description" => __("This hook awards / deducts points for post vote via the wpDiscuz plugin.", "wpdiscuz-mc"),
                "callback" => ["myCRED_Hook_wpDiscuz_Vote"]
            ];
            return $installed;
        }

        function add_wpDiscuz_in_references($references) {
            $references["wpdiscuz_vote_user"] = __("Comment like/dislike", "wpdiscuz-mc");
            $references["wpdiscuz_up_vote_cauthor"] = __("Received comment like/up-vote", "wpdiscuz-mc");
            $references["wpdiscuz_down_vote_cauthor"] = __("Received comment dislike/down-vote", "wpdiscuz-mc");
            return $references;
        }

        function wpdiscuzMcAdminStyles() {
            wp_register_style("wpdiscuz-mc", plugins_url("/css/wpdiscuz-mc.css", __FILE__));
            wp_enqueue_style("wpdiscuz-mc");
        }

        if (class_exists("myCRED_Hook")) :

            class myCRED_Hook_wpDiscuz_Vote extends myCRED_Hook {

                function __construct($hook_prefs, $type = "mycred_default") {
                    parent::__construct([
                        "id" => "wpdiscuz_vote",
                        "defaults" => [
                            "vote_member" => [
                                "creds_up" => 0,
                                "creds_down" => 0,
                                "log" => "%plural% for like/dislike a comment",
                                "limit" => "0/x",
                            ],
                            "vote_author" => [
                                "creds_up" => 1,
                                "creds_down" => -1,
                                "log" => "%plural% for like/dislike a comment",
                                "limit" => "0/x",
                            ],
                            "badges_ranks" => [
                                "show_badges" => 1,
                                "show_ranks" => 1,
                                "show_points" => 0,
                            ],
                        ],
                            ], $hook_prefs, $type);
                }

                public function run() {
                    wp_register_style("wpd-mycread-style", plugins_url("/css/wpd-mycread.css", __FILE__));
                    wp_enqueue_style("wpd-mycread-style");
                    if (is_rtl()) {
                        wp_register_style("wpd-mycread-rtl", plugins_url("/css/wpd-mycread-rtl.css", __FILE__));
                        wp_enqueue_style("wpd-mycread-rtl");
                    }


                    add_action("wpdiscuz_add_vote", [$this, "newVote"], 10, 2);
                    add_action("wpdiscuz_update_vote", [$this, "updateVote"], 10, 3);
                    if ($this->prefs["badges_ranks"]["show_badges"]) {
                        add_filter("wpdiscuz_after_label", [$this, "showBadges"], 111, 2);
                    }
                    if ($this->prefs["badges_ranks"]["show_ranks"]) {
                        add_filter("wpdiscuz_after_label", [$this, "showRanks"], 110, 2);
                    }
                    if ($this->prefs["badges_ranks"]["show_points"]) {
                        add_filter("wpdiscuz_after_label", [$this, "displayPoints"], 113, 2);
                    }
                }

                public function newVote($vote, $comment) {
                    $memberVotePoint = $this->prefs["vote_member"]["creds_up"];
                    $authorVotePoint = $this->prefs["vote_author"]["creds_up"];
                    if ($vote < 0) {
                        $memberVotePoint = $this->prefs["vote_member"]["creds_down"];
                        $authorVotePoint = $this->prefs["vote_author"]["creds_down"];
                    }
                    $this->addCreds($memberVotePoint, $authorVotePoint, $comment);
                }

                public function updateVote($vote, $isUserVoted, $comment) {
                    if ($vote > 0) {
                        $memberVotePoint = $this->prefs["vote_member"]["creds_down"];
                        $authorVotePoint = $this->prefs["vote_author"]["creds_down"];
                    } else {
                        $memberVotePoint = $this->prefs["vote_member"]["creds_up"];
                        $authorVotePoint = $this->prefs["vote_author"]["creds_up"];
                    }

                    if ($isUserVoted == 1 || $isUserVoted == -1) {
                        $this->addCreds(-$memberVotePoint, -$authorVotePoint, $comment);
                    } else {
                        $this->newVote($vote, $comment);
                    }
                }

                private function checkAction($uid, $commentID) {
                    global $wpdb, $mycred_log_table;
                    $sql = $wpdb->prepare("SELECT `id` FROM `{$mycred_log_table}` WHERE `ref_id` = %d AND `user_id` = %d  AND `ref`='wpdiscuz_vote_user'", $commentID, $uid);
                    return $wpdb->get_var($sql);
                }

                private function addCreds($memberVotePoint, $authorVotePoint, $comment) {
                    $currentUserId = get_current_user_id();
                    $commentAuthorId = $this->getCommentUserID($comment);
                    if ($currentUserId && !$this->over_hook_limit('vote_member', 'wpdiscuz_vote_user', $currentUserId) && !$this->core->exclude_user($currentUserId) && !$this->checkAction($currentUserId, $comment->comment_ID)) {
                        $this->core->add_creds("wpdiscuz_vote_user", $currentUserId, $memberVotePoint, $this->prefs["vote_member"]["log"], $comment->comment_ID, ["ref_type" => "wpdiscuz_vote"], $this->mycred_type);
                    }
                    $cAuthorRef = $authorVotePoint > 0 ? "wpdiscuz_up_vote_cauthor" : "wpdiscuz_down_vote_cauthor";
                    if ($commentAuthorId && !$this->over_hook_limit('vote_author', $cAuthorRef, $commentAuthorId) && !$this->core->exclude_user($commentAuthorId)) {
                        $this->core->add_creds($cAuthorRef, $commentAuthorId, $authorVotePoint, $this->prefs["vote_author"]["log"], $comment->comment_ID, ["ref_type" => "wpdiscuz_vote"], $this->mycred_type);
                    }
                }

                public function showBadges($afterLabelHtml, $comment) {
                    $userID = $this->getCommentUserID($comment);
                    if ($userID) {
                        if (function_exists("mycred_get_users_badges")) { //User Badges
                            $wpcusers_badges = mycred_get_users_badges($userID);
                            if (!empty($wpcusers_badges)) {
                                $afterLabelHtml .= "<div class='row mycred-users-badges wpdiscuz-mycred-badges-wrap'><div class='col-xs-12'>";
                                foreach ($wpcusers_badges as $badge_id => $level) {
                                    $afterLabelHtml .= "<div class='the-badge'>";
                                    if (function_exists("mycred_get_badge")) {
                                        $badge = mycred_get_badge($badge_id, $level);
                                        if ($badge && isset($badge->level_image) && $badge->level_image !== false) {
                                            $afterLabelHtml .= apply_filters("mycred_the_badge", $badge->get_image($level), $badge_id, $badge, $userID);
                                        }
                                    } else {
                                        $imageKey = ( $level > 0 ) ? "level_image" . $level : "main_image";
                                        $imgSrc = get_post_meta($badge_id, $imageKey, true);
                                        if ($imgSrc) {
                                            $afterLabelHtml .= "<img src='" . get_post_meta($badge_id, $imageKey, true) . "' class='mycred-badge earned' alt='" . get_the_title($badge_id) . "'  title='" . get_the_title($badge_id) . "' />";
                                        }
                                    }
                                    $afterLabelHtml .= "</div>";
                                }
                                $afterLabelHtml .= "</div></div>";
                            }
                        }
                    }
                    return "<div class='wpdiscuz-mycred-wrap'>" . $afterLabelHtml . "</div>";
                }

                public function showRanks($afterLabelHtml, $comment) {
                    $userID = $this->getCommentUserID($comment);
                    if ($userID) {
                        if (function_exists("mycred_get_users_rank")) { //User Rank
                            $rank = mycred_get_users_rank($userID, $this->core->cred_id);
                            if (is_object($rank)) {
                                if ($rank->logo_url) {
                                    $afterLabelHtml .= "<img src='{$rank->logo_url}' title='{$rank->title}' class='mycred-rank wp-post-image' alt='{$rank->title}'/>";
                                }
                            } else {
                                $afterLabelHtml .= mycred_get_users_rank($userID, $this->core->cred_id);
                            }
                        }
                    }
                    return "<div class='wpdiscuz-mycred-rank-wrap'>" . $afterLabelHtml . "</div>";
                }

                public function displayPoints($afterLabelHtml, $comment) {
                    $userID = $this->getCommentUserID($comment);
                    if ($userID) {
                        if (function_exists("mycred_get_users_balance")) { //User Points
                            $balance = mycred_get_users_balance($userID, $this->core->cred_id);
                            if ($balance) {
                                $myCred = mycred_core();
                                $pointsLable = $myCred->point_types[$this->core->cred_id];
                                $afterLabelHtml .= "<div class='wpdiscuz-mycred-points-wrap'>" . $pointsLable . ":&nbsp;" . $balance . "</div>";
                            }
                        }
                    }
                    return $afterLabelHtml;
                }

                /**
                 * Preference for this Hook
                 * @since 1.0
                 * @version 1.0
                 */
                public function preferences() {
                    $prefs = $this->prefs;
                    ?>
                    <label class="subheader" style="margin-right:10px;"><?php _e("Awarded Points for comment Like / Dislike", "wpdiscuz-mc"); ?>:</label>
                    <ol class="inline">
                        <li style="min-width: 250px;">
                            <label for="<?php echo $this->field_id(["vote_member", "creds_up"]); ?>"><?php _e("Member Up/Down", "wpdiscuz-mc"); ?></label>
                            <div class="h2">
                                <input type="text" name="<?php echo $this->field_name(["vote_member", "creds_up"]); ?>" id="<?php echo $this->field_id(["vote_member", "creds_up"]); ?>" value="<?php echo $this->core->format_number($prefs["vote_member"]["creds_up"]); ?>" size="8" />
                                <input type="text" name="<?php echo $this->field_name(["vote_member", "creds_down"]); ?>" id="<?php echo $this->field_id(["vote_member", "creds_down"]); ?>" value="<?php echo $this->core->format_number($prefs["vote_member"]["creds_down"]); ?>" size="8" />
                            </div>
                            <div class="form-group">
                                <label for="<?php echo $this->field_id(['vote_member', 'limit']); ?>"><?php _e('Limit', 'mycred'); ?></label>
                                <?php echo $this->hook_limit_setting($this->field_name(['vote_member', 'limit']), $this->field_id(['vote_member', 'limit']), $prefs['vote_member']['limit']); ?>
                            </div>
                        </li>
                        <li style="min-width: 250px;">
                            <label for="<?php echo $this->field_id(["vote_author", "creds_up"]); ?>"><?php _e("Comment Author Up/Down", "wpdiscuz-mc"); ?></label>
                            <div class="h2">
                                <input type="text" name="<?php echo $this->field_name(["vote_author", "creds_up"]); ?>" id="<?php echo $this->field_id(["vote_author", "creds_up"]); ?>" value="<?php echo $this->core->format_number($prefs["vote_author"]["creds_up"]); ?>" size="8" />
                                <input type="text" name="<?php echo $this->field_name(["vote_author", "creds_down"]); ?>" id="<?php echo $this->field_id(["vote_author", "creds_down"]); ?>" value="<?php echo $this->core->format_number($prefs["vote_author"]["creds_down"]); ?>" size="8" />
                            </div>
                            <div class="form-group">
                                <label for="<?php echo $this->field_id(['vote_author', 'limit']); ?>"><?php _e('Limit', 'mycred'); ?></label>
                                <?php echo $this->hook_limit_setting($this->field_name(['vote_author', 'limit']), $this->field_id(['vote_author', 'limit']), $prefs['vote_author']['limit']); ?>
                            </div>
                        </li>
                    </ol>
                    <label class="subheader"><?php _e("Log Template", "wpdiscuz-mc"); ?></label>
                    <ol>
                        <li>
                            <label for="<?php echo $this->field_id(["vote_member", "log"]); ?>"><?php _e("Member", "wpdiscuz-mc"); ?></label>
                            <div class="h2"><input type="text" name="<?php echo $this->field_name(["vote_member", "log"]); ?>" id="<?php echo $this->field_id(["vote_member", "log"]); ?>" value="<?php echo esc_attr($prefs["vote_member"]["log"]); ?>" class="long" /></div>
                            <span class="description"><?php echo $this->core->available_template_tags(["general", "comment"]); ?></span>
                        </li>
                        <li>
                            <label for="<?php echo $this->field_id(["vote_author", "log"]); ?>"><?php _e("Comment Author", "wpdiscuz-mc"); ?></label>
                            <div class="h2"><input type="text" name="<?php echo $this->field_name(["vote_author", "log"]); ?>" id="<?php echo $this->field_id(["vote_author", "log"]); ?>" value="<?php echo esc_attr($prefs["vote_author"]["log"]); ?>" class="long" /></div>
                            <span class="description"><?php echo $this->core->available_template_tags(["general", "comment"]); ?></span>
                        </li>
                    </ol>
                    <hr>
                    <label class="subheader"><?php _e("Comment Template", "wpdiscuz-mc"); ?></label>
                    <ol  style="margin-left:10px;">
                        <?php
                        $activateBages = function_exists("mycred_get_users_badges") ? 1 : 0;
                        $activateRanks = function_exists("mycred_get_users_rank") ? 1 : 0;
                        if ($activateBages || $activateRanks) {
                            ?>

                            <?php if ($activateBages) {
                                ?>
                                <li>
                                    <label for="<?php echo $this->field_id(["badges_ranks" => "show_badges"]); ?>">
                                        <input type="checkbox" name="<?php echo $this->field_name(["badges_ranks" => "show_badges"]); ?>" id="<?php echo $this->field_id(["badges_ranks" => "show_badges"]); ?>" <?php checked($prefs["badges_ranks"]["show_badges"], 1); ?> value="1" />
                                        <?php _e("Display earned Badges under comment author avatar", "wpdiscuz-mc"); ?>
                                    </label>
                                </li>
                                <?php
                            }
                            if ($activateRanks) {
                                ?>
                                <li>
                                    <label for="<?php echo $this->field_id(["badges_ranks" => "show_ranks"]); ?>">
                                        <input type="checkbox" name="<?php echo $this->field_name(["badges_ranks" => "show_ranks"]); ?>" id="<?php echo $this->field_id(["badges_ranks" => "show_ranks"]); ?>" <?php checked($prefs["badges_ranks"]["show_ranks"], 1); ?> value="1" />
                                        <?php _e("Display earned Ranks under comment author avatar", "wpdiscuz-mc"); ?>
                                    </label>
                                </li>
                                <?php
                            }
                        }
                        ?> 
                        <li>
                            <label for="<?php echo $this->field_id(["badges_ranks" => "show_points"]); ?>">
                                <input type="checkbox" name="<?php echo $this->field_name(["badges_ranks" => "show_points"]); ?>" id="<?php echo $this->field_id(["badges_ranks" => "show_points"]); ?>" <?php checked($prefs["badges_ranks"]["show_points"], 1); ?> value="1" />
                                <?php _e("Display earned Points under comment author avatar", "wpdiscuz-mc"); ?>
                            </label>
                        </li>
                    </ol>
                    <?php
                }

                public function sanitise_preferences($data) {

                    $new_data = $data;
                    if (isset($data['vote_member']['limit']) && isset($data['vote_member']['limit_by'])) {
                        $limit = sanitize_text_field($data['vote_member']['limit']);
                        if ($limit == '')
                            $limit = 0;
                        $new_data['vote_member']['limit'] = $limit . '/' . $data['vote_member']['limit_by'];
                        unset($data['vote_member']['limit_by']);
                    }

                    if (isset($data['vote_author']['limit']) && isset($data['vote_author']['limit_by'])) {
                        $limit = sanitize_text_field($data['vote_author']['limit']);
                        if ($limit == '')
                            $limit = 0;
                        $new_data['vote_author']['limit'] = $limit . '/' . $data['vote_author']['limit_by'];
                        unset($data['vote_author']['limit_by']);
                    }

                    $new_data["badges_ranks"]["show_badges"] = isset($data["badges_ranks"]["show_badges"]) ? $data["badges_ranks"]["show_badges"] : 0;
                    $new_data["badges_ranks"]["show_ranks"] = isset($data["badges_ranks"]["show_ranks"]) ? $data["badges_ranks"]["show_ranks"] : 0;
                    $new_data["badges_ranks"]["show_points"] = isset($data["badges_ranks"]["show_points"]) ? $data["badges_ranks"]["show_points"] : 0;

                    return $new_data;
                }

                private function getCommentUserID($comment) {
                    $wpdiscuz = wpDiscuz();
                    $userID = $comment->user_id;
                    if (!$userID && $wpdiscuz->options->login["isUserByEmail"]) {
                        $user = get_user_by("email", $comment->comment_author_email);
                        if ($user) {
                            $userID = $user->ID;
                        }
                    }
                    return $userID;
                }

            }

            endif;
    } else {
        add_action("admin_notices", function () {
            if (current_user_can("manage_options")) {
                echo "<div class='error'><p>" . __("wpDiscuz myCRED Integration requires wpDiscuz to be installed!", "wpdiscuz-mc") . "</p></div>";
            }
        }, 1);
    }
    if (!class_exists("myCRED_Core")) {
        add_action("admin_notices", function () {
            if (current_user_can("manage_options")) {
                echo "<div class='error'><p>" . __("Please install <a href='https://wordpress.org/plugins/mycred/' target='_blank'>myCRED plugin</a> to start using wpDiscuz - myCRED Integration addon", "wpdiscuz-mc") . "</p></div>";
            }
        }, 1);
    }
}, 13);

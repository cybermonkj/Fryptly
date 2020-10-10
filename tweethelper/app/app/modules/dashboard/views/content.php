<?php
  $posts          = $data_logs->post;
  $actities       = $data_logs->activity;
  $actities_chart = $data_chart_logs->activity;
  $posts_chart     = $data_chart_logs->post;
?>

<h6 class="pb-10 mt-10"><i class="" aria-hidden="true"></i><?=lang('automation_summary')?></h6>
<div class="row">
  <div class="col-md-6 mb-20">
    <div class="statistics_activity bg-white box-shadow height-100-p activity-report-items">
        <canvas id="statistics_activity"></canvas>
    </div>
  </div>
  <div class="col-md-6 mb-20">
    <div class="bg-white pd-20 box-shadow height-100-p">
      <div class="row">
        <?php 
          foreach ($actities as $key => $activity) {
        ?>
        <div class="col-md-6">
          <div class="project-info clearfix activity-report-item">
            <div class="project-info-left">
              <div class="icon icon text-info">
                <i class="<?=$activity->icon?>"></i>
              </div>
            </div>
            <div class="project-info-right">
              <span class="no number-result"><?=$activity->value?></span>
                  <p class="name-result"> <?=$activity->name?></p>
            </div>
          </div>
        </div>
        <?php }?>
        
        
      </div>
    </div>
  </div>

</div>

<h6 class="pb-10"><i class="" aria-hidden="true"></i><?=lang("Tweet_Summary")?></h6>
<div class="row">

  <div class="col-md-6  mb-20">
    <div class="statistics_activity activity-report-items bg-white box-shadow height-100-p">
        <canvas id="statistics_post"></canvas>
    </div>
  </div>
  <div class="col-md-6 mb-20">
    <div class="bg-white pd-20 box-shadow height-100-p">
      <div class="row">
        <?php 
          foreach ($posts as $key => $post) {
        ?>
        <div class="col-md-6">
          <div class="project-info clearfix activity-report-item">
            <div class="project-info-left">
              <div class="icon icon text-info">
                <i class="<?=$post->icon?>"></i>
              </div>
            </div>
            <div class="project-info-right">
              <span class="no  number-result"><?=$post->value?></span>
                  <p class="name-result"> <?=$post->name?></p>
            </div>
          </div>
        </div>
        <?php }?>
        
      </div>
    </div>
  </div>
</div>
<script>
  //Post
    var reportPost = {
      type: 'line',
      data: {
        labels: <?=$posts_chart->date_logs?>,
        datasets: [ {
          label: "<?=lang('Published')?>",
          fill: false,
          backgroundColor: window.chartColors.blue,
          borderColor: window.chartColors.blue,
          data: <?=$posts_chart->successed?>,
        }, {
          label: "<?=lang('Failed')?>",
          fill: false,
          backgroundColor: window.chartColors.red,
          borderColor: window.chartColors.red,
          data: <?=$posts_chart->failed?>,
        }]
      },
      options: {
        layout: {
            padding: {
                left: 5,
                right: 15,
                top: 0,
                bottom: 0
            }
        },
        maintainAspectRatio: false,
        pointDotStrokeWidth : 4,
        responsive: true,
        title: {
          display: false,
          text: 'Activities'
        },
        legend: {
            display: true,
            labels: {
                fontColor: '#404e67',
                boxWidth: 10,
            },
            position: 'top',
        },
        scales: {
          xAxes: [{
            gridLines: {
            display: false
          },
            ticks: {
                display: false,
            }
          }],
          yAxes: [{
            gridLines: {
            display: true
          },
            ticks: {
                display: true,
                maxTicksLimit: 5,
                beginAtZero: true,
                userCallback: function(label, index, labels) {
                    // when the floored value is the same as the value we have a whole number
                    if (Math.floor(label) === label) {
                        return label;
                    }

                },
            }
          }]
        }
      }
    };
    var ctx = document.getElementById("statistics_post").getContext('2d');
    var myChart = new Chart(ctx, reportPost);

    // post
    var reportActivity = {
      type: 'line',
      data: {
        labels: <?=$actities_chart->date_logs?>,
        datasets: [{
          label: "<?=lang('Likes')?>",
          backgroundColor: window.chartColors.blue,
          borderColor: window.chartColors.blue,
          data: <?=$actities_chart->like?>,
          fill: false,
        }, {
          label: "<?=lang('Reweets')?>",
          fill: false,
          backgroundColor: window.chartColors.purple,
          borderColor: window.chartColors.purple,
          data: <?=$actities_chart->reweet?>,
        }, {
          label: "<?=lang('Follows')?>",
          fill: false,
          backgroundColor: window.chartColors.green,
          borderColor: window.chartColors.green,
          data: <?=$actities_chart->follow?>,
        }, {
          label: "<?=lang('Unfollows')?>",
          fill: false,
          backgroundColor: window.chartColors.red,
          borderColor: window.chartColors.red,
          data: <?=$actities_chart->unfollow?>,
        }, {
          label: "<?=lang('direct_messages')?>",
          fill: false,
          backgroundColor: window.chartColors.orange,
          borderColor: window.chartColors.orange,
          data: <?=$actities_chart->direct_messages?>,
        }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        pointDotStrokeWidth : 4,
        title: {
          display: false,
          text: 'Activities Logs'
        },
        legend: {
            display: true,
            labels: {
                fontColor: '#404e67',
                boxWidth: 10,
            },
            position: 'top',
        },

        scales: {
          xAxes: [{
            gridLines: {
              display: false
            }
          }],
          yAxes: [{
            gridLines: {
            display: true
          },
            ticks: {
                display: true,
                maxTicksLimit: 5,
                beginAtZero: true,
                userCallback: function(label, index, labels) {
                    // when the floored value is the same as the value we have a whole number
                    if (Math.floor(label) === label) {
                        return label;
                    }

                },
            }
          }]
        }
      }
    };
    var ctx = document.getElementById("statistics_activity").getContext('2d');
    var myChart = new Chart(ctx, reportActivity);

</script>
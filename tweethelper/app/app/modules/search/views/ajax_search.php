
  <table class="stripe hover data-table-export nowrap">
    <thead>
      <tr>
        <th class="table-plus datatable-nosort"><?=lang('User_Twitter_ID')?></th>
        <th><?=lang('Recent_Tweet_content')?></th>
        <th><?=lang('Username')?></th>
        <th><?=lang('Avatar')?></th>
        <th><?=lang('Basic_Informations')?></th>
      </tr>
    </thead>
    <tbody>
      <?php 
      if(!empty($result)){
        foreach ($result as $key => $row) {
      ?>
      <tr>
        <td class="table-plus"><?=$row->user->id?></td>
        <td class="table-plus" data-toggle="tooltip" data-placement="right" title="<?=$row->text?>" ><?=(strlen($row->text)>=15)?substr($row->text,0,15).'...':$row->text?></td>
        <td><a href="https://twitter.com/<?=$row->user->screen_name?>" target="_blank"><?=$row->user->screen_name?></a></td>
        <td><a href="https://twitter.com/<?=$row->user->screen_name?>" target="_blank"><img src="<?=is_image_exists($row->user->profile_image_url)?>"></a></td>
        <td>
          <strong><?=lang('Followers')?></strong>: <?=$row->user->followers_count?>
          <br>
          <strong><?=lang('Followings')?></strong>: <?=$row->user->friends_count?>
          <br>
          <strong><?=lang('Tweets')?></strong>: <?=$row->user->statuses_count?>
          <br>
          <strong><?=lang('Location')?></strong>: <?=$row->user->location?>
        </td>
      </tr>
      <?php }}?>
    </tbody>
  </table>

  <script>
    $('document').ready(function(){
      $('.data-table-export').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        columnDefs: [{
          targets: "datatable-nosort",
          orderable: false,
        }],
        "lengthMenu": [[100, -1], [100, "All"]],
        "language": {
          "info": "_START_-_END_ of _TOTAL_ entries",
          searchPlaceholder: "Search"
        },
        dom: 'Bfrtip',
        buttons: [
        'copy', 'csv', 'pdf', 'print'
        ]
      });
    });
  </script>

  <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });
  </script>
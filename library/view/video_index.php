<?php require_once __DIR__ . '/_header_logged_user.php'; ?>
<?php require_once __DIR__ . '/../model/video.class.php'; ?>
<?php
function embed($url)
{
    $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
    $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';
    
    if (preg_match($longUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }

    if (preg_match($shortUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }
    return 'https://www.youtube.com/embed/' . $youtube_id ;
}

 ?>

<?php require_once __DIR__."/../view/pretrazivanje_tag.php"; ?>

<table>
  <?php
  $j = 0;
  foreach ($videi as $video)
  {
    if($j === 0)
    {
      echo "<tr>";
    }
    ?>
        <td>
        <iframe width="330" height="200"
          src=<?php echo embed($video); ?>
          title="YouTube video player" frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen></iframe>
        </td>
      <?php
    ++$j;
    if($j === 4)
    {
      echo "</tr>";
      $j = 0;
    }
  }
?>
</table>

<?php require_once __DIR__ . '/povratak_navigacija.php'; ?>
<?php require_once __DIR__ . '/_footer.php'; ?>

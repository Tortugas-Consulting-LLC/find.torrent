<!DOCTYPE html>
<html>
<head>
  <title>find.torrent :: <?= ucwords($rel); ?></title>
  <link href="//netdna.bootstrapcdn.com/bootswatch/2.3.1/cosmo/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="//yandex.st/highlightjs/7.3/styles/zenburn.min.css" rel="stylesheet" type="text/css"/>
</head>
<body>
  <div id="container">
    <div class="navbar">
      <div class="navbar-inner">
        <a class="brand" href="https://github.com/Tortugas-Consulting-LLC/find.torrent">find.torrent</a>
        <ul class="nav">
          <li><a href="/">Root URI</a></li>
          <li><a href="/rels/">Documentation Home</a></li>
        </ul>
      </div>
    </div>
    <h1 id="rel"><?= ucwords($rel); ?></h1>
    <?= \Michelf\MarkdownExtra::defaultTransform($yield); ?>
  </div>
  <script src="//yandex.st/highlightjs/7.3/highlight.min.js"></script>
  <script>hljs.initHighlightingOnLoad();</script>
</body>
</html>

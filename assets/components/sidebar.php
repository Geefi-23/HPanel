<?php 
  $base_uri = '/painel';
  $links = [
    [
      "type" => "Inicio",
      "href" => $base_uri."/",
      "icon" => 'fas fa-user-alt'
    ],
    [
      "type" => "Coordenadores",
      "href" => $base_uri."/coordenadores",
      "icon" => 'fas fa-desktop'
    ],
    [
      "type" => "Noticias",
      "href" => $base_uri."/noticias",
      "icon" => 'fas fa-user-friends'
    ],
    [
      "type" => "Rádio",
      "href" => $base_uri."/radio",
      "icon" => 'fas fa-play'
    ],
    [
      "type" => "Pack Música",
      "href" => $base_uri."/musicas",
      "icon" => 'fas fa-music'
    ],
    [
      "type" => "Compráveis",
      "href" => $base_uri."/compraveis",
      "icon" => 'fas fa-receipt'
    ],
    [
      "type" => "HabbletXD Home",
      "href" => $base_uri."/habbletxd-home",
      ""
    ],
    [
      "type" => "Desenvolvedor",
      "href" => $base_uri."/dev",
      "icon" => 'fas fa-cog'
    ],
    [
      "type" => "Sair",
      "href" => $base_uri."/assets/backend/crud/user/logout.php",
      "icon" => 'fas fa-sign-out-alt'
    ]
    
  ];
?>
<div id="sidebar">
  <div id="user-area">
    <div id="avatar" class="m-auto"></div>
    <h3 id="user-area__name" class="text-white text-center m-0 mt-2">Geefi</h3>
    <div id="user-area__role" class="text-white text-center">Desenvolvedor</div>
  </div>
  <nav>
    <ul class="nav__menu">
      <?php foreach($links as $link):?>
      <li class="nav__link">
        <a class="<?php if ($_SERVER['REQUEST_URI'] == $link["href"]) echo 'active'; ?>"
        href="<?php echo $link["href"] ?>">
          <i class="<?php echo $link["icon"];?>"></i>
          <span class="ms-2"><?php echo $link['type']; ?></span>
        </a>
      </li>
      <?php endforeach;?>
    </ul>
  </nav>
</div>
<script src="/painel/assets/js/sidebar.js"></script>
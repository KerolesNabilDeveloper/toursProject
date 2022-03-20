<div class="slim-navbar">
    <div class="container">
        <ul class="nav">

            <?php foreach($menu_links as $menu_title=>$menu_link): ?>

                <?php if(isset($menu_link["childs"])): ?>

                    <li class="nav-item with-sub">
                        <a class="nav-link" href="{{$menu_link["link"]}}">
                            <i class="{{$menu_link["icon"]}}"></i>
                            <span>{{$menu_title}}</span>
                        </a>
                        <div class="sub-item">
                            <ul>
                                <?php foreach($menu_link["childs"] as $key=>$child): ?>
                                    <li><a href="{{$child}}">{{$key}}</a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div><!-- dropdown-menu -->
                    </li>

                <?php else: ?>

                    <li class="nav-item">
                        <a class="nav-link" href="{{$menu_link["link"]}}">
                            <i class="{{$menu_link["icon"]}}"></i>
                            <span>{{$menu_title}}</span>
                        </a>
                    </li>

                <?php endif; ?>

            <?php endforeach; ?>

        </ul>
    </div><!-- container -->
</div><!-- slim-navbar -->

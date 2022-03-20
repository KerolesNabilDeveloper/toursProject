<div class="slim-sidebar">
    <label class="sidebar-label"></label>

    <ul class="nav nav-sidebar">
        <?php foreach($menu_links as $menu_title=>$menu_link): ?>

            <?php if(isset($menu_link["childs"])): ?>

                <li class="sidebar-nav-item with-sub">
                    <a href="{{$menu_link["link"]}}" class="sidebar-nav-link">
                        <i class="{{$menu_link["icon"]}}"></i>
                        {{$menu_title}}
                    </a>
                    <ul class="nav sidebar-nav-sub">
                        <?php foreach($menu_link["childs"] as $key=>$child): ?>
                            <li class="nav-sub-item"><a href="{{$child}}" class="nav-sub-link">{{$key}}</a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>

            <?php else: ?>

                <li class="sidebar-nav-item">
                    <a href="{{$menu_link["link"]}}" class="sidebar-nav-link">
                        <i class="{{$menu_link["icon"]}}"></i>
                        {{$menu_title}}
                    </a>
                </li>

            <?php endif; ?>

        <?php endforeach; ?>

    </ul>
</div><!-- slim-sidebar -->

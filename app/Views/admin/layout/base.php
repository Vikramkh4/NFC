<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />

    <link rel="icon" href="<?=base_url();?>/assets/img/logo-ct-dark.png">

    <title>
    <?= $title ?>
  </title>

    <link rel="stylesheet" href="<?=base_url();?>/assets2/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="<?=base_url();?>/assets2/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="<?=base_url();?>/assets2/css/bootstrap.css">
    <link rel="stylesheet" href="<?=base_url();?>/assets2/css/neon-core.css">
    <link rel="stylesheet" href="<?=base_url();?>/assets2/css/neon-theme.css">
    <link rel="stylesheet" href="<?=base_url();?>/assets2/css/neon-forms.css">
    <link rel="stylesheet" href="<?=base_url();?>/assets2/css/custom.css">
    <script src="<?=base_url();?>/assets2/js/jquery-1.11.3.min.js"></script>
    

    <!--[if lt IE 9]><script src="/assets2/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>

<body class="page-body  page-fade" data-url="http://neon.dev">

    <div class="page-container">
        <!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

        <div class="sidebar-menu">

            <div class="sidebar-menu-inner">

                <header class="logo-env">

                    <!-- logo -->
                    <div class="logo">
                        <a href="<?= base_url(AD.'/') ?>">
                            <img src="<?=base_url();?>/assets/img/logoh.png" class="navbar-brand-img h-32px"
                                alt="main_logo" width="50px" style="background-color:aliceblue">

                            <span class="xs-1 font-weight-bold">NFC CARD</span>
                        </a>
                    </div>
                    <!-- logo collapse icon -->
                    <div class="sidebar-collapse">
                        <a href="#" class="sidebar-collapse-icon">
                            <!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                            <i class="entypo-menu"></i>
                        </a>
                    </div>

                    <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                    <div class="sidebar-mobile-menu visible-xs">
                        <a href="#" class="with-animation">
                            <!-- add class "with-animation" to support animation -->
                            <i class="entypo-menu"></i>
                        </a>
                    </div>

                </header>


                <ul id="main-menu" class="main-menu">
                    <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                    <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                    <li class="active ">
                        <a href="<?= base_url(AD.'/') ?>">
                            <i class="entypo-gauge"></i>
                            <span class="title">Dashboard</span>
                        </a>

                    </li>
                    <li>
                        <a href="<?= base_url(AD . 'blog_list') ?>">
                            <i class="entypo-star"></i>
                            <span class="title">Review</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= base_url(AD . 'categoryview') ?>">
                            <i class="entypo-layout"></i>
                            <span class="title">Category</span>
                        </a>

                    </li>
                    <li>
                        <a href="<?= base_url(AD . 'viewtable') ?>">
                            <i class="entypo-basket"></i>
                            <span class="title">Market</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url(AD . 'banner_table') ?>">
                        <i class="entypo-vkontakte"></i>
                            <span class="title">Banner</span>
                        </a>

                    </li>
                    <li>
                        <a href="<?= base_url(AD . 'amenity_table') ?>">
                            <i class="entypo-layout"></i>
                            <span class="title">Amenities</span>
                        </a>

                    </li>
                    <li>
                        <a href="<?= base_url(AD . 'cummunitytable') ?>" target="_blank">
                            <i class="entypo-user"></i>
                            <span class="title">User Add Community Table</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url(AD . 'community') ?>">
                            <i class="entypo-newspaper"></i>
                            <span class="title">Community</span>
                        </a>
                    </li>
                    <li>
                        <a href="mailbox.html">
                            <i class="entypo-basket"></i>
                            <span class="title">Market</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url(AD . 'user') ?>">
                            <i class="entypo-users"></i>
                            <span class="title">Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url(AD . 'allbrand') ?>">
                            <i class="entypo-box"></i>
                            <span class="title">All Brand</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url(AD . 'allService') ?>">
                            <i class="entypo-chart-bar"></i>
                            <span class="title">All Services</span>
                        </a>

                    </li>
                </ul>

            </div>

        </div>

        <div class="main-content">

<div class="row">

    <!-- Profile Info and Notifications -->
    <div class="col-md-6 col-sm-8 clearfix">

        <ul class="user-info pull-left pull-none-xsm">

            

        </ul>

        <ul class="user-info pull-left pull-right-xs pull-none-xsm">





            </li>

            



                        </ul>
                    </li>

            </li>


    </div>


    <!-- Raw Links -->
    <div class="col-md-6 col-sm-4 clearfix hidden-xs">

        <ul class="list-inline links-list pull-right">





            <li class="sep"></li>

            <li>
                <a href="<?=base_url('logout')?>">
                    Log Out <i class="entypo-logout right"></i>
                </a>
            </li>
        </ul>

    </div>

</div>

<hr />
<?=$this->renderSection("content")?>

<footer class="main">

    &copy; 2024 <strong></strong> Created by Swifnix <a href="http://laborator.co"
        target="_blank"></a>

</footer>
</div>


<div id="chat" class="fixed" data-current-user="Art Ramadani" data-order-by-status="1"
data-max-chat-history="25">

<div class="chat-inner">


    <h2 class="chat-header">
        <a href="#" class="chat-close"><i class="entypo-cancel"></i></a>

        <i class="entypo-users"></i>
        Chat
        <span class="badge badge-success is-hidden">0</span>
    </h2>


    <div class="chat-group" id="group-1">
        <strong>Favorites</strong>

        <a href="#" id="sample-user-123" data-conversation-history="#sample_history"><span
                class="user-status is-online"></span> <em>Catherine J. Watkins</em></a>
        <a href="#"><span class="user-status is-online"></span> <em>Nicholas R. Walker</em></a>
        <a href="#"><span class="user-status is-busy"></span> <em>Susan J. Best</em></a>
        <a href="#"><span class="user-status is-offline"></span> <em>Brandon S. Young</em></a>
        <a href="#"><span class="user-status is-idle"></span> <em>Fernando G. Olson</em></a>
    </div>


    <div class="chat-group" id="group-2">
        <strong>Work</strong>

        <a href="#"><span class="user-status is-offline"></span> <em>Robert J. Garcia</em></a>
        <a href="#" data-conversation-history="#sample_history_2"><span
                class="user-status is-offline"></span> <em>Daniel A. Pena</em></a>
        <a href="#"><span class="user-status is-busy"></span> <em>Rodrigo E. Lozano</em></a>
    </div>


    <div class="chat-group" id="group-3">
        <strong>Social</strong>

        <a href="#"><span class="user-status is-busy"></span> <em>Velma G. Pearson</em></a>
        <a href="#"><span class="user-status is-offline"></span> <em>Margaret R. Dedmon</em></a>
        <a href="#"><span class="user-status is-online"></span> <em>Kathleen M. Canales</em></a>
        <a href="#"><span class="user-status is-offline"></span> <em>Tracy J. Rodriguez</em></a>
    </div>

</div>

<!-- conversation template -->
<div class="chat-conversation">

    <div class="conversation-header">
        <a href="#" class="conversation-close"><i class="entypo-cancel"></i></a>

        <span class="user-status"></span>
        <span class="display-name"></span>
        <small></small>
    </div>

    <ul class="conversation-body">
    </ul>

    <div class="chat-textarea">
        <textarea class="form-control autogrow" placeholder="Type your message"></textarea>
    </div>

</div>

</div>


<!-- Chat Histories -->
<ul class="chat-history" id="sample_history">
<li>
    <span class="user">Art Ramadani</span>
    <p>Are you here?</p>
    <span class="time">09:00</span>
</li>

<li class="opponent">
    <span class="user">Catherine J. Watkins</span>
    <p>This message is pre-queued.</p>
    <span class="time">09:25</span>
</li>

<li class="opponent">
    <span class="user">Catherine J. Watkins</span>
    <p>Whohoo!</p>
    <span class="time">09:26</span>
</li>

<li class="opponent unread">
    <span class="user">Catherine J. Watkins</span>
    <p>Do you like it?</p>
    <span class="time">09:27</span>
</li>
</ul>




<!-- Chat Histories -->
<ul class="chat-history" id="sample_history_2">
<li class="opponent unread">
    <span class="user">Daniel A. Pena</span>
    <p>I am going out.</p>
    <span class="time">08:21</span>
</li>

<li class="opponent unread">
    <span class="user">Daniel A. Pena</span>
    <p>Call me when you see this message.</p>
    <span class="time">08:27</span>
</li>
</ul>


</div>

<!-- Sample Modal (Default skin) -->
<div class="modal fade" id="sample-modal-dialog-1">
<div class="modal-dialog">
<div class="modal-content">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Widget Options - Default Modal</h4>
    </div>

    <div class="modal-body">
        <p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw.
            Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end
            marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope.
            Secure active living depend son repair day ladies now.</p>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div>
</div>
</div>
</div>

<!-- Sample Modal (Skin inverted) -->
<div class="modal invert fade" id="sample-modal-dialog-2">
<div class="modal-dialog">
<div class="modal-content">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Widget Options - Inverted Skin Modal</h4>
    </div>

    <div class="modal-body">
        <p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw.
            Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end
            marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope.
            Secure active living depend son repair day ladies now.</p>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div>
</div>
</div>
</div>

<!-- Sample Modal (Skin gray) -->
<div class="modal gray fade" id="sample-modal-dialog-3">
<div class="modal-dialog">
<div class="modal-content">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Widget Options - Gray Skin Modal</h4>
    </div>

    <div class="modal-body">
        <p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw.
            Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end
            marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope.
            Secure active living depend son repair day ladies now.</p>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div>
</div>
</div>
</div>




<!-- Imported styles on this page -->
<link rel="stylesheet" href="<?=base_url();?>/assets2/js/jvectormap/jquery-jvectormap-1.2.2.css">
<link rel="stylesheet" href="<?=base_url();?>/assets2/js/rickshaw/rickshaw.min.css">

<!-- Bottom scripts (common) -->
<script src="<?=base_url();?>/assets2/js/gsap/TweenMax.min.js"></script>
<script src="<?=base_url();?>/assets2/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="<?=base_url();?>/assets2/js/bootstrap.js"></script>
<script src="<?=base_url();?>/assets2/js/joinable.js"></script>
<script src="<?=base_url();?>/assets2/js/resizeable.js"></script>
<script src="<?=base_url();?>/assets2/js/neon-api.js"></script>
<script src="<?=base_url();?>/assets2/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>


<!-- Imported scripts on this page -->
<script src="<?=base_url();?>/assets2/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
<script src="<?=base_url();?>/assets2/js/jquery.sparkline.min.js"></script>
<script src="<?=base_url();?>/assets2/js/rickshaw/vendor/d3.v3.js"></script>
<script src="<?=base_url();?>/assets2/js/rickshaw/rickshaw.min.js"></script>
<script src="<?=base_url();?>/assets2/js/raphael-min.js"></script>
<script src="<?=base_url();?>/assets2/js/morris.min.js"></script>
<script src="<?=base_url();?>/assets2/js/toastr.js"></script>
<script src="<?=base_url();?>/assets2/js/neon-chat.js"></script>



<!-- Imported scripts on this page -->
<script src="<?=base_url();?>/assets2/js/datatables/datatables.js"></script>
<script src="<?=base_url();?>/assets2/js/select2/select2.min.js"></script>

<script src="<?=base_url();?>/assets2/js/neon-chat.js"></script>

<!-- JavaScripts initializations and stuff -->
<script src="<?=base_url();?>/assets2/js/neon-custom.js"></script>


<!-- Demo Settings -->
<script src="<?=base_url();?>/assets2/js/neon-demo.js"></script>

</body>

</html>
    <!-- Start Header Menu -->
    <div class="app-header1 header py-1 d-flex">
        <div class="container-fluid">
            <div class="d-flex">
                <a class="header-brand" href="index.php">
                    <img src="<?php echo $url; ?>assets/images/brand/GypsyG logo.png" class="header-brand-img" alt="AAI">
                </a>

                <!-- Start Search bar -->
                <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>

                <div class="d-flex order-lg-2 ml-auto">
                    <!-- Request Create Button -->
                    <div class="dropdown d-none d-md-flex country-selector">
                        <a href="#" class="d-flex nav-link leading-none">
                            <div>
                                <a href="#" class="btn btn-outline-primary">
                                    TODAY PROFIT : <i class="fa fa-inr"></i> 7,00,000
                                </a>
                            </div>
                        </a>
                    </div>

                    <div class="dropdown d-none d-md-flex" >
                        <a  class="nav-link icon full-screen-link">
                            <i class="fe fe-maximize-2"  id="fullscreen-button"></i>
                        </a>
                    </div>

                    <!-- Start Notification -->
                    <div class="dropdown d-none d-md-flex">
                        <a class="nav-link icon" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class=" nav-unread badge badge-danger  badge-pill">4</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a href="#" class="dropdown-item text-center">You have 4 notification</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item d-flex pb-3">
                                <div class="notifyimg">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div>
                                    <strong>2 new Messages</strong>
                                    <div class="small text-muted">17:50 Pm</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item d-flex pb-3">
                                <div class="notifyimg">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div>
                                    <strong> 1 Event Soon</strong>
                                    <div class="small text-muted">19-10-2019</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item d-flex pb-3">
                                <div class="notifyimg">
                                    <i class="fa fa-comment-o"></i>
                                </div>
                                <div>
                                    <strong> 3 new Comments</strong>
                                    <div class="small text-muted">05:34 Am</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item d-flex pb-3">
                                <div class="notifyimg">
                                    <i class="fa fa-exclamation-triangle"></i>
                                </div>
                                <div>
                                    <strong> Application Error</strong>
                                    <div class="small text-muted">13:45 Pm</div>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item text-center">See all Notification</a>
                        </div>
                    </div>
                    <!-- End Notification -->

                    <!-- Start Message -->
                    <div class="dropdown d-none d-md-flex">
                        <a class="nav-link icon" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class=" nav-unread badge badge-warning  badge-pill">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a href="#" class="dropdown-item d-flex pb-3">
                                <img src="../../assets/images/faces/male/41.jpg" alt="avatar-img" class="avatar brround mr-3 align-self-center">
                                <div>
                                    <strong>Blake</strong> I've finished it! See you so.......
                                    <div class="small text-muted">30 mins ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item d-flex pb-3">
                                <img src="../../assets/images/faces/female/1.jpg" alt="avatar-img" class="avatar brround mr-3 align-self-center">
                                <div>
                                    <strong>Caroline</strong> Just see the my Admin....
                                    <div class="small text-muted">12 mins ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item d-flex pb-3">
                                <img src="../../assets/images/faces/male/18.jpg" alt="avatar-img" class="avatar brround mr-3 align-self-center">
                                <div>
                                    <strong>Jonathan</strong> Hi! I'am singer......
                                    <div class="small text-muted">1 hour ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item d-flex pb-3">
                                <img src="../../assets/images/faces/female/18.jpg" alt="avatar-img" class="avatar brround mr-3 align-self-center">
                                <div>
                                    <strong>Emily</strong> Just a reminder that you have.....
                                    <div class="small text-muted">45 mins ago</div>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item text-center">View all Messages</a>
                        </div>
                    </div>
                    <!-- End Message -->

                    <div class="dropdown ">
                        <a href="#" class="nav-link pr-0 leading-none user-img" data-toggle="dropdown">
                        <img src="<?php 
                            if($profile_picture !== 'uploads/default.png') {
                                echo $profile_picture; 
                            } else { ?>
                                <?php echo $url; ?>assets/images/other/default-user.png
                            <?php }
                            
                            ?>" alt="profile-img" class="avatar avatar-md brround">
                        </a>

                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
                            <a class="dropdown-item" href="settings.php">
                                <i class="dropdown-icon  icon icon-settings"></i> Settings
                            </a>

                            <a class="dropdown-item" href="logout.php">
                                <i class="dropdown-icon icon icon-power"></i> Log out
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Menu -->

    <!-- Start Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>

    <aside class="app-sidebar doc-sidebar">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div>
                    <img src="<?php 
                        if($profile_picture !== 'uploads/default.png') {
                            echo $profile_picture; 
                        } else { ?>
                            <?php echo $url; ?>assets/images/other/default-user.png
                        <?php }
                    
                    ?>" alt="profile-img" class="avatar avatar-md brround">
                </div>

                <div class="user-info">
                    <h2><?php if(isset($name)) echo $name; ?></h2>
                    <small><?php if(isset($email)) echo $email; ?></small>
                </div>
            </div>
        </div>

        <ul class="side-menu">
            <li class="slide">
                <a class="side-menu__item" href="index.php">
                    <i class="side-menu__icon fa fa-tachometer"></i>
                    <span class="side-menu__label">
                        DASHBOARD
                    </span>
                </a>
            </li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="side-menu__icon fa fa-cogs"></i>
                    <span class="side-menu__label">
                        MASTER SETUP
                    </span>
                    <i class="angle fa fa-angle-right"></i>
                </a>
                
                <ul class="slide-menu">
                    <li>
                        <a href="pin-code.php" class="slide-item">PIN CODE SETUP</a>
                    </li>

                    <li>
                        <a href="branch.php" class="slide-item">BRANCH SETUP</a>
                    </li>

                    <li>
                        <a href="package-setup.php" class="slide-item">PACKAGE SETUP</a>
                    </li>
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="side-menu__icon fa fa-sitemap"></i>
                    <span class="side-menu__label">
                        PRIME AGENCY
                    </span>
                    <i class="angle fa fa-angle-right"></i>
                </a>
                
                <ul class="slide-menu">
                    <li>
                        <a href="create-agency.php" class="slide-item">CREATE AGENCY</a>
                    </li>

                    <li>
                        <a href="agency-pending.php" class="slide-item">PENDING REQUESTS</a>
                    </li>

                    <li>
                        <a href="all-agency.php" class="slide-item">ALL AGENCYS</a>
                    </li>
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="side-menu__icon fa fa-user-plus"></i>
                    <span class="side-menu__label">
                        VENDORS
                    </span>
                    <i class="angle fa fa-angle-right"></i>
                </a>
                
                <ul class="slide-menu">
                    <li>
                        <a href="create-vendor.php" class="slide-item">CREATE VENDOR</a>
                    </li>

                    <li>
                        <a href="all-vendor.php" class="slide-item">ALL VENDORS</a>
                    </li>
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="side-menu__icon fa fa-star"></i>
                    <span class="side-menu__label">
                        SELLERS
                    </span>
                    <i class="angle fa fa-angle-right"></i>
                </a>
                
                <ul class="slide-menu">
                    <li>
                        <a href="create-seller.php" class="slide-item">CREATE SELLER</a>
                    </li>

                    <li>
                        <a href="all-seller.php" class="slide-item">ALL SELLERS</a>
                    </li>
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="side-menu__icon fa fa-users"></i>
                    <span class="side-menu__label">
                        CUSTOMERS
                    </span>
                    <i class="angle fa fa-angle-right"></i>
                </a>
                
                <ul class="slide-menu">
                    <li>
                        <a href="customers.php" class="slide-item">ALL CUSTOMERS</a>
                    </li>
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="side-menu__icon fa fa-shopping-bag"></i>
                    <span class="side-menu__label">
                        ORDERS
                    </span>
                    <i class="angle fa fa-angle-right"></i>
                </a>
                
                <ul class="slide-menu">
                    <li>
                        <a href="live-orders.php" class="slide-item">LIVE ORDERS</a>
                    </li>

                    <li>
                        <a href="completed-orders.php" class="slide-item">COMPLETED ORDERS</a>
                    </li>

                    <li>
                        <a href="cancelled-orders.php" class="slide-item">CANCELLED ORDERS</a>
                    </li>

                    <li>
                        <a href="refund-orders.php" class="slide-item">REFUND ORDERS</a>
                    </li>
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="side-menu__icon fa fa-bank"></i>
                    <span class="side-menu__label">
                        ACCOUNT
                    </span>
                    <i class="angle fa fa-angle-right"></i>
                </a>
                
                <ul class="slide-menu">
                    <li>
                        <a href="#" class="slide-item">SET COMISSON</a>
                    </li>
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="side-menu__icon fa fa-pie-chart"></i>
                    <span class="side-menu__label">
                        REPORTS
                    </span>
                    <i class="angle fa fa-angle-right"></i>
                </a>
                
                <ul class="slide-menu">
                    <li>
                        <a href="#" class="slide-item">SELL REPORT</a>
                    </li>
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item" href="settings.php">
                    <i class="side-menu__icon fa fa-cog"></i>
                    <span class="side-menu__label">
                        SETTINGS
                    </span>
                </a>
            </li>
        </ul>
    </aside>
    <!-- End Sidebar menu-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Binary Admin</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link
      href="http://fonts.googleapis.com/css?family=Open+Sans"
      rel="stylesheet"
      type="text/css"
    />
    <link rel="stylesheet" href="./assets/css/responsive.css">
  </head>
  <body>
    <div id="wrapper">
      <nav
        class="navbar navbar-default navbar-cls-top"
        role="navigation"
        style="margin-bottom: 0"
      >
        <div class="navbar-header">
          <button
            type="button"
            class="navbar-toggle"
            data-toggle="collapse"
            data-target=".sidebar-collapse"
          >
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">Qjen Admin</a>
        </div>
        <div
          style="
            color: white;
            padding: 15px 50px 5px 50px;
            float: right;
            font-size: 16px;
          "
        >
          <a href="#" class="btn btn-danger square-btn-adjust">Logout</a>
        </div>
      </nav>
      <!-- /. NAV TOP  -->
      <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
              <img
                src="assets/img/find_user.png"
                class="user-image img-responsive"
              />
            </li>

            <li>
              <a class="active-menu" href="index.php"
                ><i class="fa fa-dashboard fa-3x"></i> Dashboard</a
              >
            </li>
            <li>
              <a class="" href="add_products.php"
                ><i class="fa fa-desktop fa-3x"></i>Add products</a
              >
            </li>
            <li>
              <a href="view_products.php"
                ><i class="fa fa-qrcode fa-3x"></i> View Products</a
              >
            </li>
            <li>
              <a href="insert_category.php"
                ><i class="fa fa-chevron-down fa-3x"></i> Add Categories</a
              >
            </li>
            <li>
              <a href="view_category.php"
                ><i class="fa fa-check-circle fa-3x"></i> View Categories</a
              >
            </li>
            <li>
              <a href="insert_brand.php"
                ><i class="fa fa-bell-o fa-3x"></i> Add Brands</a
              >
            </li>
            <li>
              <a href="view_brand.php"
                ><i class="fa fa-bar-chart-o fa-3x"></i> View Brands</a
              >
            </li>
            <li>
              <a href="view_user.php"
                ><i class="fa fa-rocket fa-3x"></i> View Users</a
              >
            </li>
            <li>
              <a href="table.php"
                ><i class="fa fa-table fa-3x"></i> Table Examples</a
              >
            </li>
            <li>
              <a href="form.php"><i class="fa fa-edit fa-3x"></i> Forms </a>
            </li>

            <li>
              <a href="#"
                ><i class="fa fa-sitemap fa-3x"></i> Multi-Level Dropdown<span
                  class="fa arrow"
                ></span
              ></a>
              <ul class="nav nav-second-level">
                <li>
                  <a href="#">Second Level Link</a>
                </li>
                <li>
                  <a href="#">Second Level Link</a>
                </li>
                <li>
                  <a href="#"
                    >Second Level Link<span class="fa arrow"></span
                  ></a>
                  <ul class="nav nav-third-level">
                    <li>
                      <a href="#">Third Level Link</a>
                    </li>
                    <li>
                      <a href="#">Third Level Link</a>
                    </li>
                    <li>
                      <a href="#">Third Level Link</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
            <li>
              <a href="blank.php"
                ><i class="fa fa-square-o fa-3x"></i> Blank Page</a
              >
            </li>
          </ul>
        </div>
      </nav>
      <!-- /. NAV SIDE  -->
      <div id="page-wrapper">
        <div id="page-inner">
          <div class="row">
            <div class="col-md-12">
              <h2>Admin Dashboard</h2>
              <h5>Welcome Jhon Deo , Love to see you back.</h5>
            </div>
          </div>
          <!-- /. ROW  -->
          <hr />
          <div class="row">
            <a href="view_products.php"><div class="col-md-3 col-sm-6 col-xs-6">
              <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-red set-icon">
                  <i class="fa fa-list-alt"></i>
                </span>
                <div class="text-box">
                  <p class="main-text">120 New </p>
                  <p class="text-muted">Products</p>
                </div>
              </div>
            </div></a>
            
            <div class="col-md-3 col-sm-6 col-xs-6">
              <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                  <i class="fa fa-bars"></i>
                </span>
                <div class="text-box">
                  <p class="main-text">30 Tasks</p>
                  <p class="text-muted">Remaining</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
              <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue set-icon">
                  <i class="fa fa-bell-o"></i>
                </span>
                <div class="text-box">
                  <p class="main-text">240 New</p>
                  <p class="text-muted">Notifications</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
              <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-brown set-icon">
                  <i class="fa fa-rocket"></i>
                </span>
                <div class="text-box">
                  <p class="main-text">3 Orders</p>
                  <p class="text-muted">Pending</p>
                </div>
              </div>
            </div>
          </div>
          <!-- /. ROW  -->
          <hr />
          <!-- /. ROW  -->
          <div class="row">
            <div class="col-md-9 col-sm-12 col-xs-12">
              <div class="panel panel-default">
                <div class="panel-heading">Responsive Table Example</div>
                <div class="panel-body">
                  <div class="table-responsive">
                    <table
                      class="table table-striped table-bordered table-hover"
                    >
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Username</th>
                          <th>User No.</th>
                          <th>User No.</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td>100090</td>
                          <td>100090</td>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td>Mark</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td>100090</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                          <td>100090</td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Larry</td>
                          <td>the Bird</td>
                          <td>@twitter</td>
                          <td>100090</td>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td>100090</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                          <td>100090</td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Larry</td>
                          <td>the Bird</td>
                          <td>@twitter</td>
                          <td>100090</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /. ROW  -->
          <!-- <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
              <div
                class="chat-panel panel panel-default chat-boder chat-panel-head"
              >
                <div class="panel-heading">
                  <i class="fa fa-comments fa-fw"></i>
                  Chat Box
                  <div class="btn-group pull-right">
                    <button
                      type="button"
                      class="btn btn-default btn-xs dropdown-toggle"
                      data-toggle="dropdown"
                    >
                      <i class="fa fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu slidedown">
                      <li>
                        <a href="#">
                          <i class="fa fa-refresh fa-fw"></i>Refresh
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-check-circle fa-fw"></i>Available
                        </a>
                      </li>
                      <li>
                        <a href="#"> <i class="fa fa-times fa-fw"></i>Busy </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-clock-o fa-fw"></i>Away
                        </a>
                      </li>
                      <li class="divider"></li>
                      <li>
                        <a href="#">
                          <i class="fa fa-sign-out fa-fw"></i>Sign Out
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="panel-body">
                  <ul class="chat-box">
                    <li class="left clearfix">
                      <span class="chat-img pull-left">
                        <img
                          src="assets/img/1.png"
                          alt="User"
                          class="img-circle"
                        />
                      </span>
                      <div class="chat-body">
                        <strong>Jack Sparrow</strong>
                        <small class="pull-right text-muted">
                          <i class="fa fa-clock-o fa-fw"></i>12 mins ago
                        </small>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing
                          elit. Curabitur bibendum ornare dolor, quis
                          ullamcorper ligula sodales.
                        </p>
                      </div>
                    </li>
                    <li class="right clearfix">
                      <span class="chat-img pull-right">
                        <img
                          src="assets/img/2.png"
                          alt="User"
                          class="img-circle"
                        />
                      </span>
                      <div class="chat-body clearfix">
                        <small class="text-muted">
                          <i class="fa fa-clock-o fa-fw"></i>13 mins ago</small
                        >
                        <strong class="pull-right">Jhonson Deed</strong>

                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing
                          elit. Curabitur bibendum ornare dolor, quis
                          ullamcorper ligula sodales.
                        </p>
                      </div>
                    </li>
                    <li class="left clearfix">
                      <span class="chat-img pull-left">
                        <img
                          src="assets/img/3.png"
                          alt="User"
                          class="img-circle"
                        />
                      </span>
                      <div class="chat-body clearfix">
                        <strong>Jack Sparrow</strong>
                        <small class="pull-right text-muted">
                          <i class="fa fa-clock-o fa-fw"></i>14 mins ago</small
                        >

                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing
                          elit. Curabitur bibendum ornare dolor, quis
                          ullamcorper ligula sodales.
                        </p>
                      </div>
                    </li>
                    <li class="right clearfix">
                      <span class="chat-img pull-right">
                        <img
                          src="assets/img/4.png"
                          alt="User"
                          class="img-circle"
                        />
                      </span>
                      <div class="chat-body clearfix">
                        <small class="text-muted">
                          <i class="fa fa-clock-o fa-fw"></i>15 mins ago</small
                        >
                        <strong class="pull-right">Jhonson Deed</strong>

                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing
                          elit. Curabitur bibendum ornare dolor, quis
                          ullamcorper ligula sodales.
                        </p>
                      </div>
                    </li>
                    <li class="left clearfix">
                      <span class="chat-img pull-left">
                        <img
                          src="assets/img/1.png"
                          alt="User"
                          class="img-circle"
                        />
                      </span>
                      <div class="chat-body">
                        <strong>Jack Sparrow</strong>
                        <small class="pull-right text-muted">
                          <i class="fa fa-clock-o fa-fw"></i>12 mins ago
                        </small>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing
                          elit. Curabitur bibendum ornare dolor, quis
                          ullamcorper ligula sodales.
                        </p>
                      </div>
                    </li>
                    <li class="right clearfix">
                      <span class="chat-img pull-right">
                        <img
                          src="assets/img/2.png"
                          alt="User"
                          class="img-circle"
                        />
                      </span>
                      <div class="chat-body clearfix">
                        <small class="text-muted">
                          <i class="fa fa-clock-o fa-fw"></i>13 mins ago</small
                        >
                        <strong class="pull-right">Jhonson Deed</strong>

                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing
                          elit. Curabitur bibendum ornare dolor, quis
                          ullamcorper ligula sodales.
                        </p>
                      </div>
                    </li>
                  </ul>
                </div>

                <div class="panel-footer">
                  <div class="input-group">
                    <input
                      id="btn-input"
                      type="text"
                      class="form-control input-sm"
                      placeholder="Type your message to send..."
                    />
                    <span class="input-group-btn">
                      <button class="btn btn-warning btn-sm" id="btn-chat">
                        Send
                      </button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
              <div class="panel panel-default">
                <div class="panel-heading">Label Examples</div>
                <div class="panel-body">
                  <span class="label label-default">Default</span>
                  <span class="label label-primary">Primary</span>
                  <span class="label label-success">Success</span>
                  <span class="label label-info">Info</span>
                  <span class="label label-warning">Warning</span>
                  <span class="label label-danger">Danger</span>
                </div>
              </div>

              <div class="panel panel-default">
                <div class="panel-heading">Donut Chart Example</div>
                <div class="panel-body">
                  <div id="morris-donut-chart"></div>
                </div>
              </div>
            </div>
          </div> -->
          <!-- /. ROW  -->
        </div>
        <!-- /. PAGE INNER  -->
      </div>
      <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- MORRIS CHART SCRIPTS -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
  </body>
</html>

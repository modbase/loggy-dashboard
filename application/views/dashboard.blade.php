<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dashboard / Site Monitor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>
    <div id="wrap">
      <div class="container container-narrow">
        <div class="page-header">
          <span class="pull-right" style="font-size: 24pt" id="clock"></span>
          <h1>Dashboard</h1>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Site</th>
              <th width="90px">Fatal errors</th>
              <th width="90px">Warnings</th>
              <th width="90px">Notices</th>
              <th width="90px">Other errors</th>
            </tr>
          </thead>
          <tbody>

            @foreach (Config::get('loggy.sites') as $id => $site)
              @if (isset($counts[$id]))
              <tr class="toggle" data-details="#site_{{ $id }}">
                <td>{{ $site['name'] }}</td>
                <td><span class="badge badge-large badge-{{ $counts[$id]['fatals'] > 0 ? ($counts[$id]['fatals'] < $site['fatal_threshold'] ? 'warning' : 'important') : 'success' }}">{{ $counts[$id]['fatals'] }}</span></td>
                <td><span class="badge badge-large badge-{{ $counts[$id]['warnings'] > 0 ? ($counts[$id]['warnings'] < $site['warning_threshold'] ? 'warning' : 'important') : 'success' }}">{{ $counts[$id]['warnings'] }}</span></td>
                <td><span class="badge badge-large badge-{{ $counts[$id]['notices'] > 0 ? ($counts[$id]['notices'] < $site['notice_threshold'] ? 'warning' : 'important') : 'success' }}">{{ $counts[$id]['notices'] }}</span></td>
                <td><span class="badge badge-large badge-{{ $counts[$id]['other'] > 0 ? ($counts[$id]['other'] < $site['other_threshold'] ? 'warning' : 'important') : 'success' }}">{{ $counts[$id]['other'] }}</span></td>
              </tr>
              <tr class="hide" id="site_{{ $id }}">
                <td colspan="5">
        			   {{ $raw[$id] }}
                </td>
              </tr>
              @endif
            @endforeach
          </tbody>
        </table>    
      </div>
      <div id="push"></div>
    </div>
    <div id="footer">
      <div class="container container-narrow">
        <p class="pull-right">
          <a href="#prev"><i class="icon icon-step-backward"></i></a>
          <a href="#next"><i class="icon icon-step-forward"></i></a>
        </p>
        <!-- TODO: do this via Ajax -->
        <p><i class="icon icon-warning-sign"></i> <strong>Last event:</strong> <span class="muted">[Modbase]</span> Uncaught Exception: blabla</p>
      </div>
    </div>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
  </body>
</html>
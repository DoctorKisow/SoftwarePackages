<?php

class SoftwarePackages {
  static function packageInfo($input, array $args, Parser $parser, PPFrame $frame) {
    $atom = $args['atom'];
    $type = $args['type'];

    if ($atom === NULL) {
      return "Package name missing";
    } else {
      return array(self::fetchOrError($atom, $type), 'markerType' => 'nowiki');
    }
  }

  static function fetchOrError($atom, $type) {
    $json_str = Http::get("https://packages.kisow.org/packages/" . $atom . ".json");

    if ($json_str === false) {
      return '<div class="alert alert-danger">Cannot load package information. Is the atom <em>' . htmlspecialchars($atom) . '</em> correct?</div>';
    } else {
      $json = json_decode($json_str, true);

      if ($type === 'use') {
        return self::render($json);
      } else {
        return '<div class="alert alert-danger">Unknown type parameter value.</div>';
      }
    }
  }

  static function render($json) {
    $use_flags = self::renderFlags($json);
    $updated_at = strftime('%Y-%m-%d %H:%M', strtotime($json['updated_at']));
    $desc = htmlspecialchars($json['description']);

    return <<<HTML
      <div class="panel panel-default gp-panel">
        <div class="panel-heading gp-panel-heading">
          <h3 class="panel-title">
            <span class="text-muted">USE flags for</span>
            <a href="${json['href']}">${json['atom']}</a>
            <small><span class="fa fa-external-link-square"></span></small>
            <small class="gp-pkg-desc">${desc}</small>
          </h3>
        </div>
        <div class="table-responsive gp-useflag-table-container">
          ${use_flags}
        </div>
        <div class="panel-footer gp-panel-footer">
          <small class="pull-right">
            Data provided by the <a href="https://packages.kisow.org">Software Database</a>
            &middot;
            Last update: ${updated_at}
          </small>
          <small>
            <a href="/wiki/Handbook:AMD64/Working/USE">More information about USE flags</a>
          </small>
        </div>
      </div>
HTML;
  }

  static function renderFlags($json) {
    $flags = self::sortFlags($json);

    $html = <<<HTML
      <table class="table gp-useflag-table">
HTML;

    foreach ($flags as $flag) {
      $name = htmlspecialchars($flag['name']);
      $desc = htmlspecialchars($flag['description']);

      $html .= <<<HTML
        <tr>
          <td>
            <code><a href="https://packages.kisow.org/useflags/${name}">${name}</a></code>
          </td>
          <td>
            ${desc}
          </td>
          <td class="gp-useflag-type">
            ${flag['type']}
          </td>
        </tr>
HTML;
    }

    $html .= <<< HTML
      </table>
HTML;

    return $html;
  }

  static function sortFlags($json) {
    $merged_flags = self::mapByFlagName(array_merge($json['use']['global'], $json['use']['local']));
    $local_flags = self::getFlagNames($json['use']['local']);
    $all_flags = self::getFlagNames($merged_flags);
    sort($all_flags);

    $result = array();
    foreach($all_flags as $flag_name) {
      $result[$flag_name] = $merged_flags[$flag_name];
      $result[$flag_name]['type'] = in_array($flag_name, $local_flags) ? 'local' : 'global';
    }

    return $result;
  }

  static function mapByFlagName($flags) {
    $result = array();

    foreach($flags as $flag) {
      $result[$flag['name']] = $flag;
    }

    return $result;
  }

  static function getFlagNames($flag_map) {
    $result = array();

    foreach($flag_map as $flag) {
      $result[] = $flag['name'];
    }

    return $result;
  }

  static function initHooks($parser) {
    global $wgOut;

    $parser->setHook('package-info', 'SoftwarePackages::packageInfo');
    $wgOut->addModules('ext.softwarePackages');
  }
}

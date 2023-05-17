<!DOCTYPE html>
<html>
<head>
  <link
      href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAACAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAERERAQARABAQAAEAAAARARARAQEQEQEBEBEBAAAAAAEQAAEBEBAQABEREQEQEAEQAAAAAAAAABAAEBABAREQEAEQEQAAAAEBAAAAABAAAAAREREBEBERERAAAQEAEAABEBEBABAQEQEQEQEBABARARAAAQEAEAABERERAAARERECzQAAe/IAAEpKAABL/gAAelcAAAJZAAD//QAA1oUAAJP6AAD/fwAAAkAAAHreAABLUgAAStIAAHreAAADwAAA"
      rel="icon" type="image/x-icon"/>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>QR Code Generator</title>
  <style>
      body{ font-size: 20px; line-height: 1.4em; font-family: "Trebuchet MS", sans-serif; color: #000;}
      input, textarea, select{font-family: Consolas, "Liberation Mono", Courier, monospace; font-size: 75%; line-height: 1.25em; border: 1px solid #aaa; }
      input:focus, textarea:focus, select:focus{ border: 1px solid #ccc; }
      label{ cursor: pointer; }
      #qrcode-settings, div#qrcode-output{ text-align: center; }
      div.qrcode{ margin: 0; padding: 0; }
      div.qrcode > div { height: 10px; }
      div.qrcode > div > span { display: inline-block; width: 10px; height: 10px; }
  </style>
  <
</head>
<body>
<?php
// https://phpqrcode.sourceforge.net/index.php#demo

// https://github.com/chillerlan/php-qrcode
// https://qr-platba.cz/pro-vyvojare/specifikace-formatu/
// https://www.cnb.cz/cs/platebni-styk/iban/iban-mezinarodni-format-cisla-uctu/
// https://www.cnb.cz/export/sites/cnb/cs/platebni-styk/.galleries/pravni_predpisy/download/vyhl_169_2011.pdf
?>

<form id="qrcode-settings">

  <label for="inputstring">Input String</label><br/><textarea name="inputstring" id="inputstring" cols="80" rows="3" autocomplete="off" spellcheck="false"></textarea><br/>

  <label for="version">Version</label>
  <input id="version" name="version" class="options" type="number" min="1" max="40" value="5" placeholder="version"/>

  <label for="maskpattern">Mask Pattern</label>
  <input id="maskpattern" name="maskpattern" class="options" type="number" min="-1" max="7" value="-1" placeholder="mask pattern"/>

  <label for="ecc">ECC</label>
  <select class="options" id="ecc" name="ecc">
    <option value="L" selected="selected">L - 7%</option>
    <option value="M">M - 15%</option>
    <option value="Q">Q - 25%</option>
    <option value="H">H - 30%</option>
  </select>

  <br/>

  <label for="quietzone">Quiet Zone
    <input id="quietzone" name="quietzone" class="options" type="checkbox" value="true"/>
  </label>

  <label for="quietzonesize">size</label>
  <input id="quietzonesize" name="quietzonesize" class="options" type="number" min="0" max="100" value="4" placeholder="quiet zone"/>

  <br/>

  <label for="output_type">Output</label>
  <select class="options" id="output_type" name="output_type">
    <option value="html">Markup - HTML</option>
    <option value="svg" selected="selected">Markup - SVG</option>
    <option value="png">Image - png</option>
    <option value="jpg">Image - jpg</option>
    <option value="gif">Image - gif</option>
    <option value="text">String - text</option>
    <option value="json">String - json</option>
  </select>

  <label for="scale">scale</label>
  <input id="scale" name="scale" class="options" type="number" min="1" max="10" value="5" placeholder="scale"/>

  <div>Finder</div>
  <label for="m_finder_light">
    <input type="text" id="m_finder_light" name="m_finder_light" class="jscolor options" value="ffffff" autocomplete="off" spellcheck="false" minlength="6" maxlength="6"/>
  </label>
  <label for="m_finder_dark">
    <input type="text" id="m_finder_dark" name="m_finder_dark" class="jscolor options" value="000000" autocomplete="off" spellcheck="false" minlength="6" maxlength="6"/>
  </label>

  <div>Finder dot</div>
  <label for="m_finder_dot_light">
    <input disabled="disabled" type="text" id="m_finder_dot_light" name="m_finder_dot_light" class="options" autocomplete="off" spellcheck="false"/>
  </label>
  <label for="m_finder_dot_dark">
    <input type="text" id="m_finder_dot_dark" name="m_finder_dot_dark" class="jscolor options" value="000000" autocomplete="off" spellcheck="false" minlength="6" maxlength="6"/>
  </label>

  <div>Alignment</div>
  <label for="m_alignment_light">
    <input type="text" id="m_alignment_light" name="m_alignment_light" class="jscolor options" value="ffffff" autocomplete="off" spellcheck="false" minlength="6" maxlength="6"/>
  </label>
  <label for="m_alignment_dark">
    <input type="text" id="m_alignment_dark" name="m_alignment_dark" class="jscolor options" value="000000" autocomplete="off" spellcheck="false" minlength="6" maxlength="6"/>
  </label>

  <div>Timing</div>
  <label for="m_timing_light">
    <input type="text" id="m_timing_light" name="m_timing_light" class="jscolor options" value="ffffff" autocomplete="off" spellcheck="false" minlength="6" maxlength="6"/>
  </label>
  <label for="m_timing_dark">
    <input type="text" id="m_timing_dark" name="m_timing_dark" class="jscolor options" value="000000" autocomplete="off" spellcheck="false" minlength="6" maxlength="6"/>
  </label>

  <div>Format</div>
  <label for="m_format_light">
    <input type="text" id="m_format_light" name="m_format_light" class="jscolor options" value="ffffff" autocomplete="off" spellcheck="false" minlength="6" maxlength="6"/>
  </label>
  <label for="m_format_dark">
    <input type="text" id="m_format_dark" name="m_format_dark" class="jscolor options" value="000000" autocomplete="off" spellcheck="false" minlength="6" maxlength="6"/>
  </label>

  <div>Version</div>
  <label for="m_version_light">
    <input type="text" id="m_version_light" name="m_version_light" class="jscolor options" value="ffffff" autocomplete="off" spellcheck="false" minlength="6" maxlength="6"/>
  </label>
  <label for="m_version_dark">
    <input type="text" id="m_version_dark" name="m_version_dark" class="jscolor options" value="000000" autocomplete="off" spellcheck="false" minlength="6" maxlength="6"/>
  </label>

  <div>Data</div>
  <label for="m_data_light">
    <input type="text" id="m_data_light" name="m_data_light" class="jscolor options" value="ffffff" autocomplete="off" spellcheck="false" minlength="6" maxlength="6"/>
  </label>
  <label for="m_data_dark">
    <input type="text" id="m_data_dark" name="m_data_dark" class="jscolor options" value="000000" autocomplete="off" spellcheck="false" minlength="6" maxlength="6"/>
  </label>

  <div>Dark Module</div>
  <label for="m_darkmodule_light">
    <input disabled="disabled" type="text" id="m_darkmodule_light" class="options" value="" autocomplete="off" spellcheck="false"/>
  </label>
  <label for="m_darkmodule_dark">
    <input type="text" id="m_darkmodule_dark" name="m_darkmodule_dark" class="jscolor options" value="000000" autocomplete="off" spellcheck="false" minlength="6" maxlength="6"/>
  </label>

  <div>Separator</div>
  <label for="m_separator_light">
    <input type="text" id="m_separator_light" name="m_separator_light" class="jscolor options" value="ffffff" autocomplete="off" spellcheck="false" minlength="6" maxlength="6"/>
  </label>
  <label for="m_separator_dark">
    <input disabled="disabled" type="text" id="m_separator_dark" class="options" value="" autocomplete="off" spellcheck="false"/>
  </label>

  <div>Quiet Zone</div>
  <label for="m_quietzone_light">
    <input type="text" id="m_quietzone_light" name="m_quietzone_light" class="jscolor options" value="ffffff" autocomplete="off" spellcheck="false" minlength="6" maxlength="6"/>
  </label>
  <label for="m_quietzone_dark">
    <input disabled="disabled" type="text" id="m_quietzone_dark" class="options" value="" autocomplete="off" spellcheck="false"/>
  </label>

  <div>logo space</div>
  <label for="m_logo_light">
    <input type="text" id="m_logo_light" name="m_logo_light" class="jscolor options" value="ffffff" autocomplete="off" spellcheck="false" minlength="6" maxlength="6"/>
  </label>
  <label for="m_logo_dark">
    <input disabled="disabled" type="text" id="m_logo_dark" class="options" value="" autocomplete="off" spellcheck="false"/>
  </label>

  <br/>
  <button type="submit">generate</button>
</form>
<div id="qrcode-output"></div>

<div><a href="https://play.google.com/store/apps/details?id=com.google.zxing.client.android">ZXing Barcode Scanner</a></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prototype/1.7.3/prototype.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscolor/2.1.1/jscolor.js"></script>
<script>
  ((form, output, url) => {

    $(form).observe('submit', ev => {
      Event.stop(ev);
      console.log("CLICK");
      new Ajax.Request(url, {
        method         : 'post',
        parameters     : ev.target.serialize(true),
        onUninitialized: $(output).update(),
        onLoading      : $(output).update('[portlandia_screaming.gif]'),
        onFailure      : response => $(output).update(response.responseJSON.error),
        onSuccess      : response => $(output).update(response.responseJSON.qrcode),
      });

    });
  })('qrcode-settings', 'qrcode-output', './qrcode-interactive.php');
</script>

</body>
</html>

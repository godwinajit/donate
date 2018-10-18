<?php

$diagnostic_descriptions = array(
  'Curl Support' => 'Curl is not currently enabled, please contact your hosting provider
                or IT professional to enable Curl support.',
  'Permalink Structure' => "By default WordPress uses web URLs which have question marks
                and lots of numbers in them; however, this default structure
                will not work with the Unbounce Plugin. Please update your
                <a href=\"{$permalink_url}\">WordPress Permalink
                Structure</a> and change to anything other than the default
                WordPress setting.",
  'Domain is Authorized' => "Your Domain ({$domain}) needs to be added to your
                Unbounce account, please return to the main plugin page, select
                \"Add My Domain In Unbounce\". After adding your domain in
                Unbounce, return to the main plugin page and select the \"Update
                WordPress Enabled Domains\".",
  'Can Fetch Page Listing' => 'We are unable to fetch the page listing from Unbounce, please
                contact your hosting provider or IT professional to ensure Curl
                Supported is installed and enabled.',
  'Supported PHP Version' => 'The Unbounce Pages plugin is supported when using PHP version
                5.3 or higher, please contact your hosting provider or IT
                professional and update to a supported version.',
  'Supported Wordpress Version' => 'The Unbounce Pages plugin is supported on WordPress versions 4.0
                and higher, please contact your hosting provider or IT
                professional and update to a supported version.',
);

?>
<div class="ub-plugin-wrapper">
  <img class="ub-logo" src="<?php echo $img_url; ?>" />
  <h1 class="ub-unbounce-pages-heading">Unbounce Pages Diagnostics</h1>
  <a href="<?php echo admin_url('admin.php?page=unbounce-pages'); ?>">Main Plugin Page</a>
  <br/>
  <ul class="ub-diagnostics-checks">
    <?php foreach ($checks as $check => $success) : ?>
    <?php $css_class = ($success ? 'dashicons-yes' : 'dashicons-no-alt'); ?>
      <li>
        <span class='dashicons <?php echo $css_class; ?>'></span>
        <?php
        echo $check;

        if (!$success) {
            foreach ($diagnostic_descriptions as $title => $description) {
                if ($title == $check) {
                    echo '<p class="ub-diagnostics-check-description">' . $description . '</p>';
                }
            }
        }
        ?>
      </li>
    <?php endforeach; ?>
  </ul>

  <h2>Details</h2>
  <p>
    If you are experiencing problems with the Unbounce Pages plugin, or if the problem
    continues to persist after all checks have passed, please email the following details
    to <a href="mailto:support@unbounce.com">support@unbounce.com</a>. If possible,
    please also provide details on your hosting provider.
  </p>
  <textarea id="ub-diagnostics-text" rows="10" cols="100">
<?php

foreach ($details as $detail_name => $detail) {
    echo "[${detail_name}] ${detail}\n";
}

    ?>
  </textarea>
  <div id="ub-diagnostics-copy-result"></div>
    <?php

    echo get_submit_button(
        'Copy to Clipboard',
        'primary',
        'ub-diagnostics-copy',
        false,
        array('data-clipboard-target' => '#ub-diagnostics-text')
    );

    ?>
</div>

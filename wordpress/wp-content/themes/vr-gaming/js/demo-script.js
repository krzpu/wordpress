var mep_plugin_array = [
  {
    'name'             : 'Kirki Customizer Framework',
    'slug'             : 'kirki',
    'source'           : 'https://downloads.wordpress.org/plugin/kirki.zip',
    'required'         : true,
    'force_activation' : false,
    'text-domain'      : 'kirki',
    'file_name'        : 'kirki.php'
  },
  {
    'name'             : 'Woocommerce',
    'slug'             : 'woocommerce',
    'source'           : 'https://downloads.wordpress.org/plugin/woocommerce.zip',
    'required'         : true,
    'force_activation' : false,
    'text-domain'      : 'woocommerce',
    'file_name'        : 'woocommerce.php'
  },
  {
    'name'             : 'Mosaic Gallery Advanced Gallery',
    'slug'             : 'mosaic-gallery-advanced-gallery',
    'source'           : 'https://downloads.wordpress.org/plugin/mosaic-gallery-advanced-gallery.zip',
    'required'         : true,
    'force_activation' : false,
    'text-domain'      : 'mosaic-image-gallery',
    'file_name'        : 'mosaic-image-gallery.php'
  }
];

jQuery('#demo-importer-form').on('submit', async function (e) {
  e.preventDefault();
  jQuery('.demo-importer-loader').show();

  var url = new URL(location.href);

  if(confirm("Do you really want to do this?")){
    
    jQuery('.demo-importer-loader').show();
    await sleep(300);
    mep_plugin_array.map(function (plugin_url_data, index) {
      var data_to_post = {
        action: 'ive-check-plugin-exists',
        plugin_text_domain: plugin_url_data.slug,
        main_plugin_file: plugin_url_data.file_name
      };
      var data_to_post_install = {
        action: 'ive_install_and_activate_plugin',
        plugin_details: {
          plugin_text_domain: plugin_url_data.slug,
          plugin_main_file: plugin_url_data.file_name,
          plugin_url: plugin_url_data.source
        },
        main_plugin_file: plugin_url_data.file_name
      };
      console.log('onclick');
      jQuery.ajax({
        url: vr_gaming_demo_object.ajax_url,
        type: 'post',
        data: data_to_post,
        async: false
      }).done(function (response) {
        if (response.data.install_status == true) {
          jQuery.ajax({
            url: vr_gaming_demo_object.ajax_url,
            type: 'post',
            data: data_to_post_install,
            async: false
          }).done(function (response) {
            if ((mep_plugin_array.length - 1) == index) {
              url.searchParams.append('import-demo', true);
              location.href = url;
            }
          })
        }
        else {
          wp.updates.installPlugin({
            slug: plugin_url_data.slug,
            success: function (data) {
              jQuery.ajax({
                url: vr_gaming_demo_object.ajax_url,
                type: 'post',
                data: data_to_post_install,
                async: false
              }).done(function (response) {
                if ((mep_plugin_array.length - 1) == index) {
                  url.searchParams.append('import-demo', true);
                  location.href = url;
                }
              })
            },
            error: function (data) {
              console.log(data);
            },
          });
        }
      });
    })
  }
  else {
    jQuery('.demo-importer-loader').hide();
    return false;
  }
})

function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}
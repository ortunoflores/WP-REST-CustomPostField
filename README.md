# WP-REST-CustomPostField

WordPress plugin add CPF with textarea metabox in REST API 

## How to install and customize

*  Upload the folder to the plugins section
*  Activate the plugin
*  Inside the option MY CPF on the left hand rail navigation access to the plugin
*  Fill the data using Gutenberg editor, add data on the metabox field
*  Publish the changes
*  Call the API of CPF data, there you will be able to see all the data, specially the "my-cpt-meta" with the meta data (check the section with the example)

Put your values here
`

public static \$cpf_slug = 'my-cpf';

    // Change CPF name here
    public static $cpf_name = 'My CPF';

    // Change CPF meta field name here (without spase)
    public static $cpf_meta = 'my-cpf-meta';

    // Change CPF meta field description here
    public static $cpf_meta_label = 'My test custom meta';

`

## How to call get all CPF data from
	// [https://bronceylana.com/excerciseFer/wp-json/wp/v2/my-cpf/] -- The plugin is published on this site
[http://site.com/wp-json/wp/v2/{{cpf_slug}}/](http://site.com/wp-json/wp/v2/{{cpf_slug}}/)


## Possible problems
	- Verify that the the permalinks settings are saved. Wp-admin - Settings - Permalinks , I had some problems with my hosting example for that reason , you will maybe need to deactivate and Activate again after saving the permalink.
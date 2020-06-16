# WP-REST-CustomPostField

WordPress plugin add CPF with textarea metabox in REST API 

## How to install and customize

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
	//
[http://site.com/wp-json/wp/v2/{{cpf_slug}}/](http://site.com/wp-json/wp/v2/{{cpf_slug}}/)
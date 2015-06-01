# Contact Page

### CONTACT PAGE PLUGIN FOR CAKEPHP 2.X

This plugin allows you to create a ContactPage through a Cake Plugin.

The main advantage is how easy you can start using it. 

- Supports send email
- Supports save on database
- Supports data validation 
- (NOT YET!) Supports save (one or many) files on database and send (one or many) files as attachments

## How to Install ##

First of all, you have to clone or download de zip file into directory: app>Plugin>ContactPage.

As every CakePlugin to install you need to add the code line below on bootstrap file (app>Config>bootstrap.php):

    CakePlugin::load(array('ContactPage'));

ContactPage is already working!

## How to Test ContactPage ##

To test the plugin you have to open you browser and type the follow URL:

[localhost/ContactPage/contact_page/contatos](localhost/ContactPage/contact_page/contatos "localhost/ContactPage/contact_page/contatos")


## How to Configure ContactPage Plugin ##

The configurations are made on file *PluginConfig.php* (app > Plugin > ContactPage > Config > PluginConfig.php) and you can change them.

    class PluginConfig {

	public static $config = array(
		'Contato' => array(
				'useTable' => 'contatos',
				'campos' => array('nome', 'email', 'telefone', 'estado_id', 'cidade_id', 'mensagem', 'nobot'),
			),
		'enviarEmail' => true,
		'salvar' => true,
		'assunto' => "Assunto do Email",
		'nomeDoProjeto' => "ContactPage",
		'destino' => "rjsandim@gmail.com, andremedalhaa@gmail.com",
		'template' => "padrao",
		'emailLog' => true,
		);
	}


## How to Create a Custom Route to ContactPage ##

You could create routes to your plugin ContactPage through file routes.php (app > Config > routes.php).

    Router::connect('/contato', array('plugin' => 'contact_page', 'controller' => 'contatos', 'action' => 'index'));


----------

**Version 1.1**
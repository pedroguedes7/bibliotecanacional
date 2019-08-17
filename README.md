Biblioteca Nacional
=======================

Introdução
------------
Essa aplicação foi desenvolvida para o controle na criação de usuário e livros, além de gerenciar os empréstimo
dos livro para os clientes cadastrados.
Além disso, poderão ser gerados relatórios com os empréstimos cadastrados e também a lista de clientes que 
estão devendo a devoluação de livros.
A aplicação foi desenvolvida com o Zend Framework 2, utilizando sua biblioteca nativa para banco de dados.
Também foi utilizada a biblioteca do DataTables, para gerar a criação de todas as tabelas do sistema, 
com funções dinâmicas e melhor utilização.

Instalação
------------

Instalando através do GIT
----------------------------

O repositório pode ser clonado e manualmente invocado pelo `composer` usando o arquivo
`composer.phar`:

    cd my/project/dir
    git clone https://github.com/pedroguedes7/bibliotecanacional.git
    cd bibliotecanacional
    php composer.phar self-update
    php composer.phar install

----------------

### Versão do PHP

Por questões de compatibilidade entre o PHP e o Zend Framework, é aconselhado o uso da versão 5.6 ou inferior do PHP.

----------------

### Configuração do apache

Você agora precisará criar um Virtual Host no Apache para sua aplicação e editar seu arquivo de hosts para que ao acessar http://localhost.biblioteca seja servido o arquivo index.php do diretório bibliotecanacional/public.

A configuração do Virtual Host é geralmente feita no arquivo httpd.conf ou no arquivo extra/httpd-vhosts.conf. Se você estiver usando httpd-vhosts.conf, certifique-se que esse arquivo esteja incluido no arquivo principal httpd.conf. Em algumas distribuiçõe Linux (ex: Ubuntu) os arquivos de configuração do Apache são armazenados em /etc/apache2 e são criados arquivos separados para cada Virtual Host dentro do diretório /etc/apache2/sites-enabled. Nesse caso, você deve inserir o bloco de código abaixo em um arquivo nomeado /etc/apache2/sites-enabled/bibliotecnacional.

Certifique-se que NameVirtualHost esteja definido e apontando para “*:80” ou similar, e só então defina um Virtual Host a partir das linhas abaixo:

    <VirtualHost *:8080>
    ServerName localhost.biblioteca
    DocumentRoot "C:/xampp/htdocs/bibliotecanacional/public"
    SetEnv APPLICATION_ENV "development"
    <Directory "C:/xampp/htdocs/bibliotecanacional/public">
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
    </VirtualHost>


Tenha certeza de atualizar o arquivo /etc/hosts ou c:\windows\system32\drivers\etc\hosts para que localhost.biblioteca esteja apontando para 127.0.0.1. Sua aplicação poderá então ser acessada usando http://localhost.biblioteca.

127.0.0.1               localhost.biblioteca


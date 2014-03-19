Developers documentation
========================

## How-to

As for all our packages, we try to follow the coding standards and naming rules most
commonly in use:

-   the [PEAR coding standards](http://pear.php.net/manual/en/standards.php)
-   the [PHP Framework Interoperability Group standards](https://github.com/php-fig/fig-standards).

Knowing that, all classes are named and organized in an architecture to allow the use of 
the [standard SplClassLoader](https://gist.github.com/jwage/221634).

The whole package is embedded in the `MarkdownExtended` namespace.


### Installation

You can use this package in your work in many ways.

First, you can clone the [GitHub](http://github.com/atelierspierrot/markdown-extended)
repository and include it "as is" in your poject:

    ~$ wget --no-check-certificate http://github.com/atelierspierrot/markdown-extended

You can also download an [archive](http://github.com/atelierspierrot/markdown-extended/downloads)
from Github.

Then, to use the package classes, you just need to register the `MarkdownExtended`
namespace directory using the [SplClassLoader](https://gist.github.com/jwage/221634) or
any other custom autoloader (if required, a copy is proposed in the package):

    require_once 'path/to/package/src/SplClassLoader.php';
    $classLoader = new SplClassLoader('MarkdownExtended', '/path/to/package/src');
    $classLoader->register();

Another way to use the package, if you are a [Composer](http://getcomposer.org/) user,
is to add it to your requirements in your `composer.json`:

    "require": {
        ...
        "atelierspierrot/markdown-extended": "dev-master"
    }

The namespace will be automatically added to the project's Composer autoloader.


### Usage

#### Usage for writers

To be compliant with the **extended** Markdown syntax, writers may construct their contents
following the rules described at <http://sites.ateliers-pierrot.fr/markdown-extended/markdown_reminders.html>.
For a full example and a test file, you can refer to the `demo/MD_syntax.md` file of the package ;
the latest version can be found at <http://github.com/atelierspierrot/markdown-extended/blob/master/demo/MD_syntax.md>.

#### PHP script usage

The `MarkdownExtended` package can be simply call writing:

    // creation of the singleton instance of \MarkdownExtended\MarkdownExtended
    $content = \MarkdownExtended\MarkdownExtended::create()
        // get the \MarkdownExtended\Parser object passing it some options (optional)
        ->get('Parser', $options)
        // launch the transformation of a source content
        ->parse( new \MarkdownExtended\Content($source) )
        // get the result content object
        ->getContent();

This will load in `$content` the parsed HTML version of your original Markdown `$source`.
To get the part you need from the content, write:

    echo $content->getBody();

For simplest usage, some aliases are designed in the `MarkdownExtended` kernel:

    // to parse a string content:
    \MarkdownExtended\MarkdownExtended::transformString($source [, $parser_options]);
    
    // to parse a file content:
    \MarkdownExtended\MarkdownExtended::transformSource($filename [, $parser_options]);

These two methods returns a `\MarkdownExtended\Content` object. To finally get an HTML
version, write:

    \MarkdownExtended\MarkdownExtended::transformString($source [, $parser_options]);
    echo \MarkdownExtended\MarkdownExtended::getFullContent();

#### Old parsers compatibility

To keep the package compatible with old versions of Markdown, an interface is embedded
with the common `Markdown($content)` function ; to use it, just include the file
`src/markdown.php`:

    require_once 'path/to/src/markdown.php';
    
    // to get result of a string parsing:
    echo Markdown($string [, $options]);

    // to get result of a file content parsing:
    echo MarkdownFromSource($file_name [, $options]);

#### Command line usage

A short command line interface is proposed in the package running:

    ~$ bin/markdown-extended --help

This interface allows you to parse one or more files, extract some informations from sources,
write the results in files and some other stuff.

To generate a man-page from file `docs/MANPAGE.md` with the interface itself, run:

    ~$ bin/markdown-extended -f man -o bin/markdown-extended.man docs/MANPAGE.md
    ~$ man ./bin/markdown-extended.man

#### Apache handler usage

A sample of direct [Apache](http://www.apache.org/) handler is designed in the `demo/cgi-scripts/`
directory of the package. It allows you to automatically transform Markdown content files
in HTML thru a browser classic navigation. To learn more about this feature, please see the
dedicated [How-To](docs/Apache-Handler-HOWTO.md).


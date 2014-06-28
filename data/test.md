Test "aboutmde.org" design
==========================

This page is a test for this website design and rendering (used for development).
It is not accessible in "production" mode.

## Classic (but complete) "lorem ipsum"

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ornare arcu a nibh 
pulvinar mattis. Sed id lobortis dolor. Praesent sit amet egestas dolor. Curabitur nec 
pellentesque nisi. Sed mollis porta diam ac aliquam. Fusce vitae tristique nibh, eget 
varius velit. Cras vitae purus diam. Ut interdum metus et velit viverra lobortis. 

**Nullam eu tincidunt est**, id laoreet tellus. Proin dolor nunc, *sollicitudin sit amet 
pharetra id*, aliquet eu turpis. Aenean `laoreet sit` amet augue ac blandit. Curabitur 
[tempor non sem sit amet](http://test.com/) commodo.

Nulla vel erat <kbd>iac</kbd> ulis purus laoreet adipiscing. In viverra <var>posuere nisl</var> 
eu sollicitudin.

>   Cras nisi sapien, feugiat in nisl nec, pharetra faucibus ipsum. Suspendisse viverra 
    magna et quam ultrices, elementum elementum metus bibendum.

Maecenas venenatis metus gravida[^1] Sed ultrices commodo lacus, ac semper dolor lobortis eu. 
Aenean sodales malesuada consectetur. Etiam in libero eget sem auctor mollis vel vel purus. 
Aenean nunc augue, sagittis ut pellentesque non, dapibus ac dui. Nullam nec tortor elit. 

    // foo bar stuff
    echo "Hello World!"

Etiam gravida tempus dolor, sed tincidunt magna posuere quis. Vivamus eget nisi[^2] eget 
quam accumsan faucibus. Ut sed odio arcu. Duis et fermentum est, aliquam venenatis dolor.
Fusce at sodales massa. Ut ut leo nec ligula aliquam tincidunt.

[^1]: sollicitudin arcu eget, interdum magna. Morbi ornare nisl quis pellentesque adipiscing.
[^2]: Fusce eu tortor sapien. 

*[gravida]: Etiam gravida tempus dolor, sed tincidunt magna posuere quis.

-   Sed nisl mi, volutpat et adipiscing eget
+   Faucibus quis mauris: 
    -   Quisque quis lectus dui.
    *   Integer consectetur tincidunt arcu id rhoncus.
-   Phasellus mattis metus ut elementum sollicitudin.
*   Pellentesque pharetra nunc metus, quis feugiat felis commodo ac.
    +   Suspendisse potenti.
    +   Donec semper:
        -   sapien vitae aliquet elementum
        +   eros eros euismod felis
        *   eu tincidunt nulla enim vitae dui.

Etiam ullamcorper varius turpis vel cursus. Aenean vitae iaculis dui, ut dignissim felis.

Maecenas pellentesque
:   Ipsum ut urna elementum, vitae vulputate dui sagittis. Aliquam libero lectus, varius 
    a convallis et, dictum ac lacus. Suspendisse quam enim, tempus eget vulputate quis,
    pretium ac libero.

:   Nullam gravida lacinia metus, sit amet commodo ante viverra id.

Etiam interdum
:   Orci non lobortis imperdiet, purus velit dignissim ipsum, sed bibendum felis libero quis enim.

Phasellus felis diam, adipiscing ac consectetur et, lacinia at sapien.

1.  Donec sollicitudin imperdiet egestas.
1.  Nullam mauris mi, iaculis ac massa nec:
    2.  Eleifend gravida eros. Vivamus consequat nisi a condimentum aliquam.
    3.  Sed scelerisque justo diam, sed fermentum arcu imperdiet eget.
    1.  Mauris feugiat tortor tortor, sit amet faucibus odio cursus quis.
2.  Integer elementum ligula vel mollis convallis. Donec dapibus velit et nulla placerat feugiat.

Sed iaculis congue diam. Phasellus eget orci et nulla aliquet interdum. Aenean aliquam nibh 
sed auctor tristique. Cras nunc dui, euismod id massa et, sollicitudin euismod urna.

~~~~
// foo bar stuff
echo "Hello World!"
~~~~

----

## Alert boxes

### Box with class "ab-info"

<div class="ab-box ab-info" markdown="1">
Lorem ipsum **dolor sit** amet, consectetuer [adipiscing elit](http://test.com/) ; *donec non enim* in `turpis pulvinar` facilisis. Ut felis.
</div>

### Box with class "ab-info" with "data-alert-link=false"

<div class="ab-box ab-info" data-alert-link="false" markdown="1">
Lorem ipsum **dolor sit** amet, consectetuer [adipiscing elit](http://test.com/) ; *donec non enim* in `turpis pulvinar` facilisis. Ut felis.
</div>

### Box with class "ab-alert"

<div class="ab-box ab-alert" markdown="1">
Lorem ipsum **dolor sit** amet, consectetuer [adipiscing elit](http://test.com/) ; *donec non enim* in `turpis pulvinar` facilisis. Ut felis.
</div>

### Box with class "ab-alert" with "data-icon='fa-bug fa-2x'"

<div class="ab-box ab-alert" data-icon="fa-bug fa-2x" markdown="1">
Lorem ipsum **dolor sit** amet, consectetuer [adipiscing elit](http://test.com/) ; *donec non enim* in `turpis pulvinar` facilisis. Ut felis.
</div>

### Box with class "ab-warning"

<div class="ab-box ab-warning" markdown="1">
Lorem ipsum **dolor sit** amet, consectetuer [adipiscing elit](http://test.com/) ; *donec non enim* in `turpis pulvinar` facilisis. Ut felis.
</div>

### Box with class "ab-warning ab-dismissable"

<div class="ab-box ab-warning ab-dismissable" markdown="1">
Lorem ipsum **dolor sit** amet, consectetuer [adipiscing elit](http://test.com/) ; *donec non enim* in `turpis pulvinar` facilisis. Ut felis.
</div>

### Box with class "ab-idea"

<div class="ab-box ab-idea" markdown="1">
Lorem ipsum **dolor sit** amet, consectetuer [adipiscing elit](http://test.com/) ; *donec non enim* in `turpis pulvinar` facilisis. Ut felis.
</div>

### Box with class "ab-idea" with "data-alert-link=true"

<div class="ab-box ab-idea" data-alert-link="true" markdown="1">
Lorem ipsum **dolor sit** amet, consectetuer [adipiscing elit](http://test.com/) ; *donec non enim* in `turpis pulvinar` facilisis. Ut felis.
</div>

### Box with class "ab-note"

<div class="ab-box ab-note" markdown="1">
Lorem ipsum **dolor sit** amet, consectetuer [adipiscing elit](http://test.com/) ; *donec non enim* in `turpis pulvinar` facilisis. Ut felis.
</div>

### Box with class "ab-note ab-margin"

<div class="ab-box ab-note ab-margin" markdown="1">
Lorem ipsum **dolor sit** amet, consectetuer [adipiscing elit](http://test.com/) ; *donec non enim* in `turpis pulvinar` facilisis. Ut felis.
</div>

### Box with class "ab-code"

<div class="ab-box ab-code" markdown="1">
Lorem ipsum **dolor sit** amet, consectetuer [adipiscing elit](http://test.com/) ; *donec non enim* in `turpis pulvinar` facilisis. Ut felis.
</div>

### Box with class "ab-code" and  "data-alert-type=info"

<div class="ab-box ab-code" data-alert-type="info" markdown="1">
Lorem ipsum **dolor sit** amet, consectetuer [adipiscing elit](http://test.com/) ; *donec non enim* in `turpis pulvinar` facilisis. Ut felis.
</div>

### In-text box pulled right

<div class="ab-box ab-note pull-right" markdown="1">
Lorem ipsum **dolor sit** amet, consectetuer [adipiscing elit](http://test.com/) ; *donec non enim* in `turpis pulvinar` facilisis. Ut felis.
</div>

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ornare arcu a nibh pulvinar mattis. Sed id lobortis dolor. Praesent sit amet egestas dolor. Curabitur nec pellentesque nisi. Sed mollis porta diam ac aliquam. Fusce vitae tristique nibh, eget varius velit. Cras vitae purus diam. Ut interdum metus et velit viverra lobortis. Nullam eu tincidunt est, id laoreet tellus. Proin dolor nunc, sollicitudin sit amet pharetra id, aliquet eu turpis. Aenean laoreet sit amet augue ac blandit. Curabitur tempor non sem sit amet commodo.

Nulla vel erat iaculis purus laoreet adipiscing. In viverra posuere nisl eu sollicitudin. Cras nisi sapien, feugiat in nisl nec, pharetra faucibus ipsum. Suspendisse viverra magna et quam ultrices, elementum elementum metus bibendum. Sed nisl mi, volutpat et adipiscing eget, faucibus quis mauris. Quisque quis lectus dui. Integer consectetur tincidunt arcu id rhoncus. Phasellus mattis metus ut elementum sollicitudin. Pellentesque pharetra nunc metus, quis feugiat felis commodo ac. Suspendisse potenti. Donec semper, sapien vitae aliquet elementum, eros eros euismod felis, eu tincidunt nulla enim vitae dui.

Maecenas venenatis metus gravida, sollicitudin arcu eget, interdum magna. Morbi ornare nisl quis pellentesque adipiscing. Sed ultrices commodo lacus, ac semper dolor lobortis eu. Aenean sodales malesuada consectetur. Etiam in libero eget sem auctor mollis vel vel purus. Aenean nunc augue, sagittis ut pellentesque non, dapibus ac dui. Nullam nec tortor elit. Etiam gravida tempus dolor, sed tincidunt magna posuere quis. Fusce eu tortor sapien. Vivamus eget nisi eget quam accumsan faucibus. Ut sed odio arcu. Duis et fermentum est, aliquam venenatis dolor. Fusce at sodales massa. Ut ut leo nec ligula aliquam tincidunt. 

### In-text box pulled left

<div class="ab-box ab-note pull-left" markdown="1">
Lorem ipsum **dolor sit** amet, consectetuer [adipiscing elit](http://test.com/) ; *donec non enim* in `turpis pulvinar` facilisis. Ut felis.
</div>

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ornare arcu a nibh pulvinar mattis. Sed id lobortis dolor. Praesent sit amet egestas dolor. Curabitur nec pellentesque nisi. Sed mollis porta diam ac aliquam. Fusce vitae tristique nibh, eget varius velit. Cras vitae purus diam. Ut interdum metus et velit viverra lobortis. Nullam eu tincidunt est, id laoreet tellus. Proin dolor nunc, sollicitudin sit amet pharetra id, aliquet eu turpis. Aenean laoreet sit amet augue ac blandit. Curabitur tempor non sem sit amet commodo.

Nulla vel erat iaculis purus laoreet adipiscing. In viverra posuere nisl eu sollicitudin. Cras nisi sapien, feugiat in nisl nec, pharetra faucibus ipsum. Suspendisse viverra magna et quam ultrices, elementum elementum metus bibendum. Sed nisl mi, volutpat et adipiscing eget, faucibus quis mauris. Quisque quis lectus dui. Integer consectetur tincidunt arcu id rhoncus. Phasellus mattis metus ut elementum sollicitudin. Pellentesque pharetra nunc metus, quis feugiat felis commodo ac. Suspendisse potenti. Donec semper, sapien vitae aliquet elementum, eros eros euismod felis, eu tincidunt nulla enim vitae dui.

Maecenas venenatis metus gravida, sollicitudin arcu eget, interdum magna. Morbi ornare nisl quis pellentesque adipiscing. Sed ultrices commodo lacus, ac semper dolor lobortis eu. Aenean sodales malesuada consectetur. Etiam in libero eget sem auctor mollis vel vel purus. Aenean nunc augue, sagittis ut pellentesque non, dapibus ac dui. Nullam nec tortor elit. Etiam gravida tempus dolor, sed tincidunt magna posuere quis. Fusce eu tortor sapien. Vivamus eget nisi eget quam accumsan faucibus. Ut sed odio arcu. Duis et fermentum est, aliquam venenatis dolor. Fusce at sodales massa. Ut ut leo nec ligula aliquam tincidunt. 

### In-text box pulled left with class "small"

<div class="ab-box ab-note pull-left small" markdown="1">
Lorem ipsum **dolor sit** amet, consectetuer [adipiscing elit](http://test.com/) ; *donec non enim* in `turpis pulvinar` facilisis. Ut felis.
</div>

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ornare arcu a nibh pulvinar mattis. Sed id lobortis dolor. Praesent sit amet egestas dolor. Curabitur nec pellentesque nisi. Sed mollis porta diam ac aliquam. Fusce vitae tristique nibh, eget varius velit. Cras vitae purus diam. Ut interdum metus et velit viverra lobortis. Nullam eu tincidunt est, id laoreet tellus. Proin dolor nunc, sollicitudin sit amet pharetra id, aliquet eu turpis. Aenean laoreet sit amet augue ac blandit. Curabitur tempor non sem sit amet commodo.

Nulla vel erat iaculis purus laoreet adipiscing. In viverra posuere nisl eu sollicitudin. Cras nisi sapien, feugiat in nisl nec, pharetra faucibus ipsum. Suspendisse viverra magna et quam ultrices, elementum elementum metus bibendum. Sed nisl mi, volutpat et adipiscing eget, faucibus quis mauris. Quisque quis lectus dui. Integer consectetur tincidunt arcu id rhoncus. Phasellus mattis metus ut elementum sollicitudin. Pellentesque pharetra nunc metus, quis feugiat felis commodo ac. Suspendisse potenti. Donec semper, sapien vitae aliquet elementum, eros eros euismod felis, eu tincidunt nulla enim vitae dui.

Maecenas venenatis metus gravida, sollicitudin arcu eget, interdum magna. Morbi ornare nisl quis pellentesque adipiscing. Sed ultrices commodo lacus, ac semper dolor lobortis eu. Aenean sodales malesuada consectetur. Etiam in libero eget sem auctor mollis vel vel purus. Aenean nunc augue, sagittis ut pellentesque non, dapibus ac dui. Nullam nec tortor elit. Etiam gravida tempus dolor, sed tincidunt magna posuere quis. Fusce eu tortor sapien. Vivamus eget nisi eget quam accumsan faucibus. Ut sed odio arcu. Duis et fermentum est, aliquam venenatis dolor. Fusce at sodales massa. Ut ut leo nec ligula aliquam tincidunt. 

### In-text box pulled right with class "big"

<div class="ab-box ab-note pull-right big" markdown="1">
Lorem ipsum **dolor sit** amet, consectetuer [adipiscing elit](http://test.com/) ; *donec non enim* in `turpis pulvinar` facilisis. Ut felis.
</div>

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ornare arcu a nibh pulvinar mattis. Sed id lobortis dolor. Praesent sit amet egestas dolor. Curabitur nec pellentesque nisi. Sed mollis porta diam ac aliquam. Fusce vitae tristique nibh, eget varius velit. Cras vitae purus diam. Ut interdum metus et velit viverra lobortis. Nullam eu tincidunt est, id laoreet tellus. Proin dolor nunc, sollicitudin sit amet pharetra id, aliquet eu turpis. Aenean laoreet sit amet augue ac blandit. Curabitur tempor non sem sit amet commodo.

Nulla vel erat iaculis purus laoreet adipiscing. In viverra posuere nisl eu sollicitudin. Cras nisi sapien, feugiat in nisl nec, pharetra faucibus ipsum. Suspendisse viverra magna et quam ultrices, elementum elementum metus bibendum. Sed nisl mi, volutpat et adipiscing eget, faucibus quis mauris. Quisque quis lectus dui. Integer consectetur tincidunt arcu id rhoncus. Phasellus mattis metus ut elementum sollicitudin. Pellentesque pharetra nunc metus, quis feugiat felis commodo ac. Suspendisse potenti. Donec semper, sapien vitae aliquet elementum, eros eros euismod felis, eu tincidunt nulla enim vitae dui.

Maecenas venenatis metus gravida, sollicitudin arcu eget, interdum magna. Morbi ornare nisl quis pellentesque adipiscing. Sed ultrices commodo lacus, ac semper dolor lobortis eu. Aenean sodales malesuada consectetur. Etiam in libero eget sem auctor mollis vel vel purus. Aenean nunc augue, sagittis ut pellentesque non, dapibus ac dui. Nullam nec tortor elit. Etiam gravida tempus dolor, sed tincidunt magna posuere quis. Fusce eu tortor sapien. Vivamus eget nisi eget quam accumsan faucibus. Ut sed odio arcu. Duis et fermentum est, aliquam venenatis dolor. Fusce at sodales massa. Ut ut leo nec ligula aliquam tincidunt. 


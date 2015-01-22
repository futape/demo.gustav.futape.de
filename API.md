Gustav's API provides an interface for interacting with Gustav, the source files, the destination files etc.  
Most often, to identify an object, being a GvBlock, a destination file or something else, the path of the corresponding source files is used.  
The API documentation is split into the following parts.

<dl>
    <dt><a href="Public-API"><em>Public API</em></a></dt>
    <dd>This section describes class member that are defined as <code>public</code> and don't belong to the Dev API.</dd>
    
    <dt><a href="Private-API"><em>Private API</em></a></dt>
    <dd>The private API contains class members that are defined as <code>protected static</code> and don't belong to the Dev API.</dd>
    
    <dt><a href="Dev-API"><em>Dev API</em></a></dt>
    <dd>Class members defined as <code>pivate</code> or such that actually should be but aren't due to technical restrictions for example are contained in the Dev API. This section contains information on the <em>real</em> implementation details and not just on the public interfaces.</dd>
</dl>



##Gustav classes

The API is implemented using Gustav classes.  
*Gustav classes* are called that way because all of their names begin with `Gustav`.  
Some classes are abstract while others allow to create instances of the class. Some class member are private while others are public.  
Gustav classes are defined in the namespace `futape\gustav`.  
The following Gustav classes exist.

###`Gustav`

This class provides useful functions for interacting with the Gustav system.  
It's an abstract class and can therefore not be instantiated. All members are defined as `static`.  
The class is defined in `Gustav.php`.  
All Gustav classes, except for [`GustavBase`](#gustavbase), inherit from this class. This class extends [`GustavBase`](#gustavbase). When including `Gustav.php`, besides `GustavHooks.php`, also [`GustavBase.php`](#gustavbase), as well as [`GustavSrc.php`](#gustavsrc) and [`GustavDest.php`](#gustavdest) are included.

###`GustavSrc`

A `GustavSrc` object represents a source file. It provides useful functions and information on that file.  
The class is defined in `GustavSrc.php`.  
This class extends [`Gustav`](#gustav). When including `GustavSrc.php`, besides `GustavSrcHooks.php`, also [`Gustav.php`](#gustav), as well as [`GustavContent.php`](#gustavcontent) and [`GustavBlock.php`](#gustavblock) are included.  

###`GustavDest`

A `GustavDest` object represents a destination file. It provides useful functions and information on that file.  
The class is defined in `GustavDest.php`.  
This class extends [`Gustav`](#gustav). When including `GustavDest.php`, besides `GustavDestHooks.php`, also [`Gustav.php`](#gustav) and [`GustavSrc.php`](#gustavsrc) are included.  

###`GustavContent`

A `GustavContent` object represents a source file's content aka. [*source content*](Source-content).  
The class is defined in `GustavContent.php`.  
This class extends [`Gustav`](#gustav). When including `GustavContent.php`, besides `GustavContentHooks.php`, also [`Gustav.php`](#gustav) and [`GustavBlock.php`](#gustavblock) are included.  

###`GustavBlock`

A `GustavBlock` object represents a source file's GvBlock.  
The class is defined in `GustavBlock.php`.  
This class extends [`Gustav`](#gustav). When including `GustavBlock.php`, besides `GustavBlockHooks.php`, also [`GustavDestHooks.php`](#gustavdesthooks) and [`GustavContentHooks.php`](#gustavcontenthooks) are included.  

###`GustavGenerator`

This class provides useful functions for genrating destination files or destination contents. For example, this class is used by `generate.php` and PHP destination files.  
It's an abstract class and can therefore not be instantiated. All members are defined as `static`.  
The class is defined in `GustavGenerator.php`.  
This class extends [`Gustav`](#gustav). When including `GustavGenerator.php`, besides `GustavGeneratorHooks.php`, also [`GustavSrc.php`](#gustavsrc) and [`GustavDest.php`](#gustavdest) are included.  

###`GustavBase`

This class provides functions and other members that aren't directly related to Gustav.  
It's an abstract class and can therefore not be instantiated. All members are defined as `static`.  
The class is defined in `GustavBase.php`.  
Since `Gustav` inherits from this class and all other classes extend `Gustav`, all of this class's non-`private` members are available in all other Gustav classes. When including `GustavBase.php`, also `GustavBaseHooks.php` is included.  

###Hooks classes

Hooks classes are a subset of the Gustav classes. Like the Gustav classes' ones, their names begin with `Gustav`, too. *Hooks classes* are called that way because their names are made up of the Gustav classes' names being a name's beginning and `Hooks` ending a name.  
For each Gustav class one Hooks class exists. When including a Gustav class, the corresponding Hooks class is included automatically.

Hooks classes make all static functions of the corresponding Gustav class publically available. They are all defined as `abstract` and can therefore not be instantiated.  
When calling a function via a Hooks class and passing a variable as reference to a parameter, it's important to pass it as `myfunc(&$myvar)` for example, while the corresponding Gustav class's function may accept `myfunc($myvar)`.

Hooks classes can be used to call functions documented in the [private API](Private-API).
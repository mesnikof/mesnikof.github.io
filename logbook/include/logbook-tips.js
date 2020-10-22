/*
 * "logbook-servers.js"
 *
 * This file contains a series of functions written in the javascript language. They are used
 * to support the fuctionality of the logbook system.
 *
 * These functions are utilized throughout the system making their inclusion as a single group
 * into each of the pages utilized/displayed by the logbook system preferable to manually
 * including them in each file.
 *
 * These scripts are not meant to be standalone.  They are meant to be included into the HTML
 * "header" block of each file.  As such they do not contain any of the usual HTML information.
 * This is assumed to exist in the files that "include" this file.
 *
 * Finally, these scripts are used to create "dynamic" actions on the user's browser, such as
 * displaying pop-up "balloon" help text.
 */

/*
 * Some needed global variables
 */
var theMsg = '.';
var topMsg = 0;
var leftMsg = 0;
var widthMsg = 0;
var tp = 0;

function validation() {
    /*
     * This function confirms that both the uname and pword fields are entered when required.
     * If either is missing a message is shown to the user, and "false" is returned.  If both
     * exist "true" is returned.  It is assumed that the calling HTML/javascript will act
     * upon this return value.
     */
    var name = document.getElementById("u_name").value;
    var email = document.getElementById("p_word").value;
    if (u_name === '' || p_word === '') {
        alert("Please fill all fields...!!!!!!");
        return false;
    }
    else {
        return true;
    }
}

/*
 * This is the constructor function for tips objects.
 * The arguments are the following:
 *   window: The Window object in which the dynamic element is to appear
 *   body: The initial body to load
 * 
 * This constructor outputs a style sheet into the current document.
 * This means that it can only be called from the <HEAD> of the document
 * before any text has been output for display.
 */
function tips(window, body) {
    // Remember some arguments for later.
    this.window = window;
    this.body = body;
    
    // Output a CSS-P style sheet for this element.
    var d = window.document;
    document.writeln('<STYLE TYPE="text/css">#tipID {position:absolute; overflow:auto; z-index:99; left:10; top:10; width:10; padding:3; background-color:#d2b48c; text-align:center; font-size:larger; font-weight:bolder;}</STYLE>');
}

/*
 * Now we define a bunch of methods for the tips class.  
 * We define one set of methods if we are running in Navigator, and
 * another set of methods if we are running in Internet Explorer, and
 * a third for Gecko-compatible browsers.
 * Note that the APIs of the methods are the same in both cases; it
 * is only the method bodies that change. In this way, we define
 * a portable API to the common DHTML functionality of the two browsers.
 */

// Define methods for Gecko compatible browsers.
if (document.getElementById) {

    // The all-important output() method
    tips.prototype.output = function() {
        var d = this.window.document;  // Shortcut variable: saves typing

        // Output the element within a <DIV> tag.  Specify the element id.
        d.writeln('<DIV ID="tipID">');
        d.writeln(this.body);
        d.writeln("</DIV>");

        /*
         * Now, for convenience, save references to the <DIV> element
         * we've created, and to its associated Style element.
         * These will be used throughout the methods that follow.
         */
        tp = document.getElementById("tipID");
        tp.style.visibility = "hidden";
    }

   // Method to set tip location
   tips.prototype.setLoc = function() {
        topMsg = (window.innerHeight + window.pageYOffset - 100);
        leftMsg = (Math.round(window.innerWidth * .1));
        widthMsg = (Math.round(window.innerWidth * .8));
   }

    // Method to locate the dynamic object
    tips.prototype.moveTo = function(l,t,w) {
        tp.style.left = l;
        tp.style.top = t;
        tp.style.width = w;
        tp.style.height = 95;
    }

    // Methods to set other attributes of the dynamic object
    tips.prototype.show = function() { tp.style.visibility = "visible"; }
    tips.prototype.hide = function() { tp.style.visibility = "hidden"; }

    // Change the contents of the dynamic element.
    tips.prototype.setBody = function() {
        var body = "";
        for(var i = 0; i < arguments.length; i++) {
            body += arguments[i] + "\n";
        }
        tp.innerHTML = body;
     }
}

// Define methods for Internet Explorer.
if (document.all) {

    // The all-important output() method
    tips.prototype.output = function() {
        var d = this.window.document;  // Shortcut variable: saves typing

        // Output the element within a <DIV> tag.  Specify the element id.
        d.writeln('<DIV ID="tipID">');
        d.writeln(this.body);
        d.writeln("</DIV>");

        // Now, for convenience, save references to the <DIV> element
        // we've created, and to its associated Style element.
        // These will be used throughout the methods that follow.
        this.element = d.all["tipID"];
        this.style = this.element.style;
        this.style.visibility = "hidden";
    }

   // Method to set tip location
   tips.prototype.setLoc = function() {
        topMsg = (document.body.clientHeight + document.body.scrollTop - 100);
        leftMsg = (Math.round(document.body.clientWidth * .1));
        widthMsg = (Math.round(document.body.clientWidth * .8));
   }

    // Method to locate the dynamic object
    tips.prototype.moveTo = function(l,t,w) {
        this.style.pixelLeft = l;
        this.style.pixelTop = t;
        this.style.width = w;
        this.style.height = 95;
   }

    // Methods to set other attributes of the dynamic object
    tips.prototype.show = function() { this.style.visibility = "visible"; }
    tips.prototype.hide = function() { this.style.visibility = "hidden"; }

    // Change the contents of the dynamic element.
    tips.prototype.setBody = function() {
        var body = "";
        for(var i = 0; i < arguments.length; i++) {
            body += arguments[i] + "\n";
        }
        this.element.innerHTML = body;
    }
}

// Define the Navigator methods.
else if (document.layers) {

    /*
     * This function outputs the dynamic element itself into the document.
     * It must be called before any other methods of the tips object can
     * be used.
     */  
    tips.prototype.output = function() {
        var d = this.window.document;  // Shortcut variable: saves typing

        // Output the element within a <DIV> tag.  Specify the element id.
        d.writeln('<DIV ID="tipID">');
        d.writeln(this.body);
        d.writeln("</DIV>");

        // Now, for convenience, save a reference to the Layer object
        // created by this dynamic element.
        this.layer = d["tipID"];
        this.layer.bgColor = "tan";
        this.layer.visibility = "hide";
    }

   // Method to set tip location
   tips.prototype.setLoc = function() {
        topMsg = (window.innerHeight + window.pageYOffset - 100);
        leftMsg = (Math.round(window.innerWidth * .1));
        widthMsg = (Math.round(window.innerWidth * .8));
   }

    // Method to locate the dynamic object
    tips.prototype.moveTo = function(l,t,w) { 
      this.layer.moveToAbsolute(l,t); 
      this.layer.clip.width = w; 
      this.layer.clip.height = 95;
    }

    // Methods to set other attributes of the dynamic object
    tips.prototype.show = function() { this.layer.visibility = "show"; }
    tips.prototype.hide = function() { this.layer.visibility = "hide"; }

    /* 
     * This method allows us to dynamically change the contents of
     * the dynamic element. The argument or arguments should be HTML
     * strings which become the new body of the element.
     */
    tips.prototype.setBody = function() {
        for(var i = 0; i < arguments.length; i++)
            this.layer.document.writeln(arguments[i]);
        this.layer.document.close();
    }
}

var theTip = new tips(window, theMsg);

function makeItVisible(body) {
  /*
   * This function, as might be expected, makes the "balloon" help text visible.
   */
  theTip.setLoc();
  theTip.moveTo(leftMsg, topMsg, widthMsg);
  theTip.setBody(body);
  theTip.show();
}

theTip.output();

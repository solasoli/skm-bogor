
<!doctype html>
<!--[if gt IE 8]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>bPopup || A jQuery modal popup plugin</title>
  <link href="http://fonts.googleapis.com/css?family=Petrona|Inconsolata|Droid+Sans" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url();?>vendor/bpopup/style.min.css">
</head>
<body>
    <div id="page">
       
        <ul>
            <li>
                <h3 class="header">1. HELLO WORLD</h3>
                <span class="button small pop1">Pop it up</span>
                <span class="example">
                    <strong>Example 1, default: </strong>
                    <em>Simple jQuery modal popup with default settings (Hello World popup)</em>
                </span>
                <pre>
        $(<span class="code-string">'element_to_pop_up'</span>).bPopup();
                </pre>
            </li>

            <li>
                <h3 class="header">2. CUSTOM SETTINGS</h3>
                <span class="button small pop1" data-bpopup='{"follow":[false,false],"position":[150,400]}'>Pop it up</span>
                <span class="example">
                    <strong>Example 2a, custom settings: </strong>
                    <em>Simple jQuery popup with custom settings (Lazy popup, not going anywhere)</em>
                </span>
                <pre>
        $(<span class="code-string">'element_to_pop_up'</span>).bPopup({
            follow: [<span class="code-function">false</span>, <span class="code-function">false</span>],<span class="code-comment"> //x, y</span>
            position: [<span class="code-int">150</span>, <span class="code-int">400</span>]<span class="code-comment"> //x, y</span>
        });
                </pre>
            </li>

            <li>
                <span class="button small pop1" data-bpopup='{"modalClose":false,"opacity":0.6,"positionStyle":"fixed"}'>Pop it up</span>
                <span class="example">
                    <strong>Example 2b, custom settings: </strong>
                    <em>Simple jQuery popup with custom settings part 2 (Sticky popup)</em>
                </span>
                <pre>
        $(<span class="code-string">'element_to_pop_up'</span>).bPopup({
            modalClose: <span class="code-function">false</span>,
            opacity: <span class="code-int">0.6</span>,
            positionStyle: <span class="code-string">'fixed'</span><span class="code-comment"> //'fixed' or 'absolute'</span>
        });
                </pre>
            </li>

            <li>
                <span class="button small pop1" data-bpopup='{"fadeSpeed":"slow", "followSpeed":1500, "modalColor":"greenYellow"}'>Pop it up</span>
                <span class="example">
                    <strong>Example 2c, custom settings: </strong>
                    <em>Simple jQuery popup with custom settings part 3 (Jamaican popup, relax man)</em>
                </span>
                <pre>
        $(<span class="code-string">'element_to_pop_up'</span>).bPopup({
            fadeSpeed: <span class="code-string">'slow'</span>,<span class="code-comment"> //can be a string ('slow'/'fast') or int</span>
            followSpeed: <span class="code-int">1500</span>,<span class="code-comment"> //can be a string ('slow'/'fast') or int</span>
            modalColor: <span class="code-string">'greenYellow'</span>
        });
                </pre>
            </li>
            <li>
                <h3 class="header">3. TRANSITIONS</h3>
                <span class="button small pop1" data-bpopup='{"transition":"slideDown","speed":850,"easing":"easeOutBack"}'>Pop it up</span>
                <span class="example">
                    <strong>Example 3a, transitions: </strong>
                    <em>Simple jQuery popup with slide down transition and easing (Falling popup)</em>
                </span>
                <pre>
        $(<span class="code-string">'element_to_pop_up'</span>).bPopup({
        easing: <span class="code-string">'easeOutBack'</span>,<span class="code-comment"> //uses jQuery easing plugin</span>
            speed: <span class="code-int">450</span>,
            transition: <span class="code-string">'slideDown'</span>
        });
                </pre>
            </li>
            <li>
                <span class="button small pop1" data-bpopup='{"transition":"slideIn","transitionClose": "slideBack","speed":650}'>Pop it up</span>
                <span class="example">
                    <strong>Example 3b, transitions: </strong>
                    <em>Simple jQuery popup with slide in transition (Formula one popup)</em>
                </span>
                <pre>
        $(<span class="code-string">'element_to_pop_up'</span>).bPopup({
            speed: <span class="code-int">650</span>,
            transition: <span class="code-string">'slideIn'</span>,
        transitionClose: <span class="code-string">'slideBack'</span>
        });
                </pre>
            </li>
            <li>
                <h3 class="header">4. EVENTS</h3>
                <span class="button small pop1 events">Pop it up</span>
                <span class="example">
                    <strong>Example 4, events: </strong>
                    <em>Simple jQuery popup that illustrates the different events (Events popup)</em>
                </span>
                <pre>
        $(<span class="code-string">'element_to_pop_up'</span>).bPopup({
            onOpen: <span class="code-function">function()</span> { alert(<span class="code-string">'onOpen fired'</span>); }, 
            onClose: <span class="code-function">function()</span> { alert(<span class="code-string">'onClose fired'</span>); }
        }, 
        <span class="code-function">function()</span> {
            alert(<span class="code-string">'Callback fired'</span>);
        });
                </pre>
            </li>
            <li>
                <h3 class="header">5. CONTENT</h3>
                <span class="button small pop2" data-bpopup='{"contentContainer":".content","loadUrl":"assets/test.html"}'>Pop it up</span>
                <span class="example">
                    <strong>Example 5a, content: </strong>
                    <em>Simple jQuery popup that loads external html page with ajax. (Ajax popup)<br>
                    <span class="code-string">Be aware that due to browser security restrictions, most "Ajax" requests are subject to the same origin policy; the request can't successfully retrieve data from a different domain, subdomain, or protocol.</span></em>
                </span>
                <pre>
        $(<span class="code-string">'element_to_pop_up'</span>).bPopup({
            contentContainer:<span class="code-string">'.content'</span>,
            loadUrl: <span class="code-string">'test.html'</span><span class="code-comment"> //Uses jQuery.load()</span>
        });
                </pre>
            </li>
            <li>
                <span class="button small pop2" data-bpopup='{"content":"image","contentContainer":".content","loadUrl":"assets/images/dog.jpg"}'>Pop it up</span>
                <span class="example">
                    <strong>Example 5b, content: </strong>
                    <em>Simple jQuery popup that loads an image (Image popup)</em>
                </span>
                <pre>
        $(<span class="code-string">'element_to_pop_up'</span>).bPopup({
            content:<span class="code-string">'image'</span>,<span class="code-comment"> //'ajax', 'iframe' or 'image'</span>
            contentContainer:<span class="code-string">'.content'</span>,
            loadUrl:<span class="code-string">'image.jpg'</span>
        });
                </pre>
            </li>
            <li>
                <span class="button small pop2" data-bpopup='{"content":"iframe","contentContainer":".content","loadUrl":"http://dinbror.dk/blog"}'>Pop it up</span>
                <span class="example">
                    <strong>Example 5c, content: </strong>
                    <em>Simple jQuery popup that loads a page inside an iframe (Iframe popup)</em>
                </span>
                <pre>
        $(<span class="code-string">'element_to_pop_up'</span>).bPopup({
            content:<span class="code-string">'iframe'</span>,<span class="code-comment"> //'ajax', 'iframe' or 'image'</span>
            contentContainer:<span class="code-string">'.content'</span>,
            loadUrl:<span class="code-string">'http://dinbror.dk/blog'</span><span class="code-comment"> //Uses jQuery.load()</span>
        });
                </pre>
            </li>
            <li>
                <span class="button small pop2 x-content" data-bpopup='<iframe width="640" height="360" src="http://www.youtube.com/embed/pPb2lIap6Es?rel=0" frameborder="0" allowfullscreen></iframe>'>Pop a video</span>
                <span class="button small pop2 x-content" data-bpopup='<img src="http://dinbror.dk/bpopup/assets/dinbror.jpg" style="height:131px;width:660px" />'>Pop an image</span>
                <span class="button small pop2 x-content" data-bpopup='010010010110011000100000011110010110111101110101001000000110<br>001101100001011011100010000001101110011011110111010000100000<br>011001110110010101110100001000000110100101110100001000000111<br>010101110000001000000010110100100000011101010111001101100101<br>001000000110001001010000011011110111000001110101011100000010<br>0001'>Pop some text</span>
                <span class="example">
                    <strong>Example 5d, content: </strong>
                    <em>Simple jQuery popup that loads X content defined on the buttons data attribute (Content popup)</em>
                </span>
                <pre>
        <span class="code-function">var</span> self = $(<span class="code-function">this</span>)<span class="code-comment"> //button</span>
        , content = $(<span class="code-string">'.content'</span>); 
        
        $(<span class="code-string">'element_to_pop_up'</span>).bPopup({
            onOpen: <span class="code-function">function()</span> {
                content.html(self.data(<span class="code-string">'bpopup'</span>) || <span class="code-string">''</span>);
            },
            onClose: <span class="code-function">function()</span> {
                content.empty();
            }
        });
                </pre>
            </li>
            <li>
                <h3 class="header">6. MISC</h3>
                <span class="button small multi">Pop it up</span>
                <span class="example">
                    <strong>Example 6a, misc: </strong>
                    <em>Multiple jQuery popups (Never ending popup, how many can you pop up?)</em>
                </span>
                <pre>
        $(<span class="code-string">'element_to_pop_up_1'</span>).bPopup({
            closeClass:<span class="code-string">'close1'</span>,
            follow: [<span class="code-function">false</span>, <span class="code-function">false</span>]<span class="code-comment"> //x, y</span>
        });
        $(<span class="code-string">'element_to_pop_up_2'</span>).bPopup({
            closeClass:<span class="code-string">'close2'</span>,
            follow: [<span class="code-function">false</span>, <span class="code-function">false</span>]<span class="code-comment"> //x, y</span>
        });
        
        ...
        
        $(<span class="code-string">'element_to_pop_up_N'</span>).bPopup({
            closeClass:<span class="code-string">'closeN'</span>,
            follow: [<span class="code-function">false</span>, <span class="code-function">false</span>]<span class="code-comment"> //x, y</span>
        });
                </pre>
            </li>
            <li>
                <span class="button small pop1" data-bpopup='{"autoClose":1000}'>Pop it up</span>
                <span class="example">
                    <strong>Example 6b, misc: </strong>
                    <em>Autoclose jQuery popup (Notification popup)</em>
                </span>
                <pre>
        $(<span class="code-string">'element_to_pop_up'</span>).bPopup({
            autoClose: <span class="code-int">1000</span><span class="code-comment"> //Auto closes after 1000ms/1sec</span>
        });
                </pre>
            </li>
            
            <li>
                <span class="button small pop1 random">Pop it up</span>
                <span class="example">
                    <strong>Example 6c, misc: </strong>
                    <em>Random jQuery popup (You never know what you get popup)</em>
                </span>
                <pre>
        $(<span class="code-string">'element_to_pop_up'</span>).bPopup({
            ???
        });
                </pre>
            </li>
            <li class="ad">
                <script type="text/javascript"><!--
                google_ad_client = "ca-pub-3114094015984236";
                google_ad_slot = "7708855451";
                google_ad_width = 728;
                google_ad_height = 90;
                //-->
                </script>
                <script type="text/javascript"
                src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                </script>
            </li>
        </ul>
        <a class="code-string" href="http://dinbror.dk/blog/bPopup">For more info visit the blog</a>
    </div>
    <a class="github" href="https://github.com/dinbror/bpopup/"></a>
    <div id="popup">
        <span class="button b-close"><span>X</span></span>
        If you can't get it up use<br><span class="logo">bPopup</span>
    </div>
    <div id="popup2">
        <span class="button b-close"><span>X</span></span>
        <div class="content"></div>
    </div>
    <script src="<?php echo base_url();?>vendor/bpopup/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url();?>vendor/bpopup/jquery-1.9.1.min.js"><\/script>')</script>
    <script src="<?php echo base_url();?>vendor/bpopup/jquery.bpopup-0.11.0.min.js"></script>
    <script src="<?php echo base_url();?>vendor/bpopup/jquery.easing.1.3.js"></script>
    <script src="<?php echo base_url();?>vendor/bpopup/scripting.min.js"></script>
</body>
</html>
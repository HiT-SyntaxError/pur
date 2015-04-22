<div id="navbar-submenu-wrapper">
    <nav class="navbar navbar-default" id="navbar-submenu">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#submenu">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>


            <div class="collapse navbar-collapse" id="submenu">
                <ul class="nav navbar-nav">

                    @if(URL::previous() != URL::current())
                        <li>
                            <a id="submenuitem1" href="{{ URL::previous() }}" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Tilbake"><span class="fa fa-level-up fa-rotate-270"></span> Tilbake</a>
                        </li>
                    @endif


                </ul>
            </div>
        </div>
    </nav>
</div>
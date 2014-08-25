<div class="row">
{{ team }}
    <div class="teams">
        <div class="col-md-4">
            <div class="team-item">
                <div class="content">
                    <div class="img" style="float:left">
                        <a href="{{ url:site }}team/{{slug}}"><img src="{{ url:site }}/files/thumb/{{ image }}/370/235/fit" class="yim-img-responsive img-border"></a>
                    </div>
                        <h2><a href="{{ url:site }}team/{{slug}}">{{name}}</a></h2>
                        {{ designation }} <br />
                        {{ location }} <br/ >
                        {{ description }}
                    </div>
                </div>
            </div>
        </div> 
    </div>
{{/team}}
</div>
<div class="paginatin-align">
{{ pagination:links }}
</div>
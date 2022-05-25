<script src="/../public/js/jquery-ui.min.js"></script>
<script src="/../public/js/jquery.validate.min.js"></script>
<script src="/../public/ajax/mailbox.js"></script>
<form method="post" id="composeReg" role="form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Compose New Message</h3>
        </div>    
        <div class="box-body">
            <div class="form-group">
                <input class="form-control" placeholder="To:" id="herodemo" name="herodemo">
                <span class="help-block" id="error"></span>
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="Subject:" id="subject" name="subject">
                <span class="help-block" id="error"></span>
            </div>
            <div class="form-group">
                <textarea id="composetextarea" name="composetextarea" class="form-control" style="height: 300px" ></textarea>
                <span class="help-block" id="error"></span>
            </div>
        </div>        
        <div class="box-footer">
            <div class="pull-right">            
                <button type="submit" class="btn btn-primary"><i class="fas fa-envelope"></i> Send</button>
            </div>
            <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
        </div>        
    </div>
</form>
<script>
    var cache = {};
    function googleSuggest(request, response) {
        var term = request.term;
        if (term in cache) {
            response(cache[term]);
            return;
        }
        $.ajax({
            url: 'https://query.yahooapis.com/v1/public/yql',
            dataType: 'JSONP',
            data: {format: 'json', q: 'select * from xml where url="http://google.com/complete/search?output=toolbar&q=' + term + '"'},
            success: function (data) {
                var suggestions = [];
                try {
                    var results = data.query.results.toplevel.CompleteSuggestion;
                } catch (e) {
                    var results = [];
                }
                $.each(results, function () {
                    try {
                        var s = this.suggestion.data.toLowerCase();
                        suggestions.push({label: s.replace(term, '<b>' + term + '</b>'), value: s});
                    }
                    catch (e) {
                    }
                });
                cache[term] = suggestions;
                response(suggestions);
            }
        });
    }
    $(function () {
        $("#composetextarea").wysihtml5();
        $('#herodemo').tagEditor({
            placeholder: 'Enter Mail Address ...',
            autocomplete: {source: googleSuggest, minLength: 3, delay: 250, html: true, position: {collision: 'flip'}}
        });
    });
</script>
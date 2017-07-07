<div class="col-xs-10 col-sm-10 col-lg-10" style="">
<form enctype="multipart/form-data" method="post" accept-charset="utf-8" role="form" action="">
    <input name="_method" value="POST" type="hidden"></div>
    <div class="row">
        <div class="col-lg-8">
            <fieldset>
                <!-- <div class="form-group url required"> -->
                    <!-- <label class="control-label" for="name">Url</label> -->
                    <?= $this->form->input('url', ['class' => 'form-control', 'height' => 50])?>
                    <!-- <textarea name="url" required="required" class="form-control" rows="5"></textarea> -->
                <!-- </div> -->
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="form-group">
                <div class="col pull-right">
                    <?= $this->Form->input('param', ['type' => 'hidden', 'value' => $param])?>
                    <button class="btn btn-primary" name="_save" type="submit">开始采集</button>
                    <a href="/zen/Collections" class="btn btn-default" role="button" value="1">Back</a>
                </div>
            </div>
        </div>
    </div>
</form>
</div>

<form role="form" name="dealForm" id="dealForm">
<input type="hidden" value="add_child_deal" name="action" id="action"/>
<input type="hidden" value="" name="deal_id" id="deal_id"/>
<input type="hidden" value="" name="parent_deal_id" id="parent_deal_id"/>
<input type="hidden" value="GBP" name="currency" id="currency"/>
<input type="hidden" value="1" name="is_active" id="is_active"/>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label class="col-md-3 control-label" for="merchant_id">Merchant Name</label>
            <div class="col-md-9 input-group">
                <span class="input-group-addon">@</span>
                <select id="merchant_id" name="merchant_id" class="form-control" required=""></select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label" for="parent_deal_name">Parent Deal</label>
            <div class="col-md-9 input-group">
            <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                <select id="parent_deal_name" name="parent_deal_name" class="form-control" required=""></select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label" for="title">Title</label>
            <div class="col-md-9 input-group">
                <span class="input-group-addon"><i class="fa fa-header"></i></span>
                <input id="title" name="title" type="text" placeholder="Deal Title" class="form-control input-md" required="">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label" for="business_name">Product Price</label>
            <div class="col-md-9 input-group">
                <span class="input-group-addon"><i class="fa fa-gbp"></i></span>
                <input id="actual_amount" name="actual_amount" class="form-control" placeholder="Product Price" type="text">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label" for="business_name">Offer Price</label>
            <div class="col-md-9 input-group">
                <span class="input-group-addon"><i class="fa fa-gbp"></i></span>
                <input id="deal_amount" name="deal_amount" class="form-control" placeholder="Offer Price" type="text">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label" for="business_name">Percentage</label>
            <div class="col-md-9 input-group">
                <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                <input id="percentage" name="percentage" class="form-control" placeholder="Percentage" type="text">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label" for="business_name">Offer Period</label>
            <div class="col-md-9 input-group">
                <div class='input-group date' id='start_child_datetimepicker'>
                    <input type='text' name="start_date" id="start_date" placeholder="From" class="form-control" required=""/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <div class='input-group date' id='end_child_datetimepicker'>
                    <input type='text' name="end_date" id="end_date" placeholder="To" class="form-control" required=""/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label" for="description">Description</label>
            <div class="col-md-9 input-group">
                <span class="input-group-addon"><i class="fa fa-info"></i></span>
                <textarea class="form-control" id="description" name="description" required=""></textarea>
            </div>
        </div>
    </div> <!-- col-lg-6 -->

</div> <!-- row -->
<div class="row">
    <div class="col-lg-5"></div>
    <div class="col-lg-2">
        <input type="button" name="submitBtn" id="submitBtn" class="btn btn-danger submitBtn" value="Submit" onClick="submitForm()"/>
        <input type="button" name="resetBtn" id="resetBtn" class="btn btn-info submitBtn" value="Reset"/>
    </div>
    <div class="col-lg-5"></div>
</div> <!-- row -->
</form>

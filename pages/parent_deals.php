<form role="form" enctype="multipart/form-data" name="dealForm" id="dealForm">
<input type="hidden" value="add_parent_deal" name="action" id="action"/>
<input type="hidden" value="" name="deal_id" id="deal_id"/>
<input type="hidden" value="0" name="parent_deal_id" id="parent_deal_id"/>
<input type="hidden" value="1" name="is_active" id="is_active"/>
<input type="hidden" value="" name="business_name" id="business_name"/>

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
            <label class="col-md-3 control-label" for="title">Title</label>
            <div class="col-md-9 input-group">
                <span class="input-group-addon"><i class="fa fa-header"></i></span>
                <input id="title" name="title" type="text" placeholder="Deal Title" class="form-control input-md" required="">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label" for="currency_select">Currency</label>
            <div class="col-md-9 input-group">
                <span class="input-group-addon"><i class="fa fa-gbp"></i></span>
                <select id="currency" name="currency" class="form-control">
                    <option value="GBP">GBP</option>
                </select>
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
            <label class="col-md-3 control-label" for="description">Description</label>
            <div class="col-md-9 input-group">
                <span class="input-group-addon"><i class="fa fa-info"></i></span>
                <textarea class="form-control" id="description" name="description" rows=5 required=""></textarea>
            </div>
        </div>

    </div> <!-- col-lg-6 -->

    <div class="col-lg-6">
        <div class="form-group">
            <label class="col-md-3 control-label" for="business_name">Offer Period</label>
            <div class="col-md-9 input-group">
                <div class='input-group date' id='start_datetimepicker'>
                    <input type='text' name="start_date" id="start_date" placeholder="From" class="form-control" required=""/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <div class='input-group date' id='end_datetimepicker'>
                    <input type='text' name="end_date" id="end_date" placeholder="To" class="form-control" required=""/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label" for="is_active">Status</label>
            <div class="col-md-9 input-group">
                <label class="radio-inline">
                    <input type="radio" name="is_active" id="status_active" value="1" checked>Active
                </label>
                <label class="radio-inline">
                    <input type="radio" name="is_active" id="status_inactive" value="0">Inactive
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label" for="redemption_count">Claimed Deals Count</label>
            <div class="col-md-9 input-group">
                <span class="input-group-addon"><i class="fa fa-plus"></i></span>
                <input id="redemption_count " name="redemption_count" class="form-control" disabled type="text">
            </div>
        </div>

        <div class="form-group" id="imageDiv">
            <label class="col-md-3 control-label" for="image_dir">Upload Images</label>
            <div class="col-md-9">
                <input id="deal_images" name="image_dir[]" class="input-file" type="file" required="" accepts="image/*" multiple>
                <span style="color:red">*Add All files together</span>
            </div>
        </div>

        <div class="append_pre_p_v">
        <div class="filearray"> </div>
        </div>

    </div> <!-- col-lg-6 -->
</div> <!-- row -->

<div class="row">
    <div class="col-lg-5"></div>
    <div class="col-lg-2">
        <input type="button" name="submitBtn" class="btn btn-danger submitBtn" value="Submit" onClick="submitForm()"/>
        <input type="button" name="resetBtn" id="resetBtn" class="btn btn-info submitBtn" value="Reset" />
    </div>
    <div class="col-lg-5"></div>
</div> <!-- row -->
</form>

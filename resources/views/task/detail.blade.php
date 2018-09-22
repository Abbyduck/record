<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Edit</h4>

        <button type="button" class="close" data-dismiss="modal"><span >&times;</span></button>
    </div>
    <div class="modal-body">
        <form id="task_detail">
            <div class="form-group">
                <label for="content" class="control-label">Task:</label>
                <input id="content" name="content" class="form-control" type="text">
            </div>
            <div class="form-group">
                <label for="color" class="control-label">Color:</label>
                <select class="custom-select" id="color" name="color">
                    <option selected>Choose...</option>
                    <option value="red" style="color: red">Red</option>
                    <option value="orange" style="color: orange">Orange</option>
                    <option value="green" style="color: green" >Green</option>
                </select>
            </div>
            <div class="form-group">
                <label for="deadline" class="control-label">Deadline:</label>
                <div class="input-group date">
                    <input id="deadline" name="deadline" class="form-control datepicker" type="datetime" data-provide="datepicker" data-date-format="yyyy-mm-dd"><span class="input-group-addon"><i class="icon icon-calendar"></i></span>
                </div>
            </div>
            <div class="form-group">
                <label for="sequence" class="control-label">Sequence:</label>
                <input id="sequence" name="sequence" class="form-control" type="text">
            </div>
            <input hidden id="id" name="ids">
            {!! csrf_field() !!}
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" id="tsave" class="btn btn-primary" value="update"  data-dismiss="modal" data-id="">提交</button>
        <input type="hidden" id="tid" name="tid" value="-1">
    </div>
</div>

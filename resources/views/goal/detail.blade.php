<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Edit</h4>

        <button type="button" class="close" data-dismiss="modal"><span >&times;</span></button>
    </div>
    <div class="modal-body">
        <form id="goal_detail">
            <div class="form-group">
                <label for="content" class="control-label">Goal:</label>
                <input id="content" name="content" class="form-control" type="text">
            </div>
            <div class="form-group">
                <label for="sequence" class="control-label">Sequence:</label>
                <input id="sequence" name="sequence" class="form-control" type="text">
            </div>
            <input hidden id="gid" name="ids">
            {!! csrf_field() !!}
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" id="gsave" class="btn btn-primary" value="update"  data-dismiss="modal" data-id="">提交</button>
        <input type="hidden" id="tid" name="tid" value="-1">
    </div>
</div>

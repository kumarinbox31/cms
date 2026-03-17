<!-- application/views/admin/find_replace.php -->
<div class="container-fluid" style="padding:20px;">

  <h3 style="margin:0 0 15px 0;">Find & Replace (ab_other_content + ab_page_content)</h3>

  <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger">
      <?php echo $this->session->flashdata('error'); ?>
    </div>
  <?php endif; ?>

  <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
      <?php echo $this->session->flashdata('success'); ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
  <?php endif; ?>

  <!-- PREVIEW FORM -->
  <div class="card" style="border:1px solid #e5e7eb; border-radius:10px; padding:16px; margin-bottom:16px;">
    <form method="post" action="<?php echo site_url('admin/find_replace_preview'); ?>">
      <div class="row" style="display:flex; flex-wrap:wrap; gap:12px;">
        <div style="flex:1; min-width:260px;">
          <label style="display:block; font-weight:600; margin-bottom:6px;">Find Text</label>
          <input
            type="text"
            name="search_text"
            value="<?php echo isset($summary['search_text']) ? html_escape($summary['search_text']) : html_escape(set_value('search_text')); ?>"
            class="form-control"
            placeholder="Enter text to find..."
            required
          >
          <small style="color:#6b7280;">This only previews results (no changes yet).</small>
        </div>

        <div style="width:240px; min-width:220px;">
          <label style="display:block; font-weight:600; margin-bottom:6px;">Search In</label>
          <div style="display:flex; flex-direction:column; gap:6px; padding-top:4px;">
            <label style="display:flex; gap:8px; align-items:center;">
              <input type="checkbox" name="in_other" value="1"
                <?php echo set_checkbox('in_other', '1', true); ?>>
              <span>ab_other_content (Header/Footer)</span>
            </label>

            <label style="display:flex; gap:8px; align-items:center;">
              <input type="checkbox" name="in_page" value="1"
                <?php echo set_checkbox('in_page', '1', true); ?>>
              <span>ab_page_content (Page Body)</span>
            </label>
          </div>
        </div>

        <div style="width:220px; min-width:200px;">
          <label style="display:block; font-weight:600; margin-bottom:6px;">Options</label>
          <label style="display:flex; gap:8px; align-items:center; padding-top:6px;">
            <input type="checkbox" name="case_sensitive" value="1" <?php echo set_checkbox('case_sensitive', '1'); ?>>
            <span>Case Sensitive</span>
          </label>
          <small style="color:#6b7280;">DB like() may still depend on collation.</small>
        </div>

        <div style="width:180px; min-width:160px; display:flex; align-items:flex-end;">
          <button type="submit" class="btn btn-primary" style="width:100%;">
            Preview
          </button>
        </div>
      </div>
    </form>
  </div>

  <?php if (!empty($summary) && isset($summary['total_rows'])): ?>
    <div class="alert alert-info" style="border-radius:10px;">
      <b>Preview Summary:</b>
      Total Rows Found: <b><?php echo (int)$summary['total_rows']; ?></b> |
      Total Occurrences: <b><?php echo (int)$summary['total_occurrences']; ?></b>
      <?php if (!empty($summary['search_text'])): ?>
        | Search: <code><?php echo html_escape($summary['search_text']); ?></code>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($results)): ?>
    <!-- APPLY REPLACE FORM -->
    <div class="card" style="border:1px solid #e5e7eb; border-radius:10px; padding:16px;">
      <form method="post" action="<?php echo site_url('admin/find_replace_apply'); ?>" id="replaceForm">

        <div class="row" style="display:flex; flex-wrap:wrap; gap:12px; align-items:flex-end; margin-bottom:14px;">
          <div style="flex:1; min-width:260px;">
            <label style="display:block; font-weight:600; margin-bottom:6px;">Replace With</label>
            <input
              type="text"
              name="replace_text"
              value="<?php echo html_escape(set_value('replace_text')); ?>"
              class="form-control"
              placeholder="Enter replacement text..."
              required
            >
            <small style="color:#6b7280;">This will update DB only after you click Replace.</small>
          </div>

          <div style="width:220px; min-width:200px;">
            <label style="display:block; font-weight:600; margin-bottom:6px;">Replace Mode</label>
            <select name="mode" class="form-control" id="modeSelect">
              <option value="selected">Replace Selected Rows</option>
              <option value="all">Replace All Found Rows</option>
            </select>
            <small style="color:#6b7280;">Selected mode is safer.</small>
          </div>

          <div style="width:220px; min-width:200px;">
            <label style="display:block; font-weight:600; margin-bottom:6px;">Options</label>
            <label style="display:flex; gap:8px; align-items:center; padding-top:6px;">
              <input type="checkbox" name="case_sensitive" value="1" <?php echo set_checkbox('case_sensitive', '1'); ?>>
              <span>Case Sensitive</span>
            </label>
          </div>

          <div style="width:220px; min-width:200px;">
            <button type="submit" class="btn btn-danger" style="width:100%;"
              onclick="return confirmReplace();">
              Apply Replace
            </button>
          </div>
        </div>

        <!-- keep the search_text and table selection for "all" mode -->
        <input type="hidden" name="search_text" value="<?php echo !empty($summary['search_text']) ? html_escape($summary['search_text']) : ''; ?>">
        <input type="hidden" name="in_other" value="1">
        <input type="hidden" name="in_page" value="1">

        <div style="display:flex; justify-content:space-between; align-items:center; gap:10px; margin-bottom:10px;">
          <div style="display:flex; gap:10px; align-items:center;">
            <button type="button" class="btn btn-secondary btn-sm" onclick="toggleAll(true)">Select All</button>
            <button type="button" class="btn btn-secondary btn-sm" onclick="toggleAll(false)">Unselect All</button>
          </div>
          <div style="color:#6b7280; font-size:13px;">
            Tip: Use <b>Replace Selected</b> first to avoid mistakes.
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-bordered table-hover" style="background:#fff;">
            <thead>
              <tr>
                <th style="width:40px; text-align:center;">
                  <input type="checkbox" id="checkAll" onclick="toggleFromMaster(this)">
                </th>
                <th style="width:160px;">Table</th>
                <th style="width:90px;">Page Name</th>
                <th style="width:90px;">ID</th>
                <th style="width:120px;">Field</th>
                <th style="width:120px;">Occurrences</th>
                <th>Preview</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($results as $row): ?>
                <tr>
                  <td style="text-align:center;">
                    <input
                      type="checkbox"
                      class="rowCheck"
                      name="selected[]"
                      value="<?php echo html_escape($row['table'].'|'.$row['id'].'|'.$row['hash']); ?>"
                      checked
                    >
                  </td>
                  <td><code><?php echo html_escape($row['table']); ?></code></td>
                  <td><code><?php echo html_escape($row['page']); ?></code></td>
                  <td><?php echo (int)$row['id']; ?></td>
                  <td><?php echo html_escape($row['field']); ?></td>
                  <td><b><?php echo (int)$row['occurrences']; ?></b></td>
                  <td style="font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace; font-size:13px;">
                    <?php echo nl2br(html_escape($row['snippet'])); ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

      </form>
    </div>

    <script>
      function toggleAll(status){
        var boxes = document.querySelectorAll('.rowCheck');
        boxes.forEach(function(b){ b.checked = status; });
        var master = document.getElementById('checkAll');
        if(master) master.checked = status;
      }

      function toggleFromMaster(el){
        toggleAll(el.checked);
      }

      function confirmReplace(){
        var mode = document.getElementById('modeSelect').value;
        if(mode === 'selected'){
          var checked = document.querySelectorAll('.rowCheck:checked').length;
          if(checked === 0){
            alert('Please select at least one row to replace.');
            return false;
          }
          return confirm('Are you sure you want to replace in SELECTED rows only?');
        }else{
          return confirm('Are you sure you want to replace in ALL found rows?');
        }
      }
    </script>

  <?php else: ?>
    <?php if (!empty($summary) && isset($summary['total_rows']) && (int)$summary['total_rows'] === 0): ?>
      <div class="alert alert-warning" style="border-radius:10px;">
        No matches found.
      </div>
    <?php endif; ?>
  <?php endif; ?>

</div>

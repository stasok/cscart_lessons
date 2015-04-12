{capture name="mainbox"}

<form action="{""|fn_url}" method="post" class="form-horizontal form-edit " name="yml_import_form" enctype="multipart/form-data">
<input type="hidden" class="cm-no-hide-input" name="fake" value="1" />

{capture name="tabsbox"}
<div id="content_manual">

    {if $log}
    {include file="common/subheader.tpl" title=__("yml_import.report") target="#import_report"}
    <div id="import_report" class="in collapse">
        {include file="addons/db_yml_import/views/yml_import/components/reports.tpl"}
    </div>
    {/if}


    {include file="common/subheader.tpl" title=__("yml_import.manual_import") target="#manual_import"}
    <div id="manual_import" class="in collapse">

        <div class="control-group">
            <label for="elm_price" class="control-label">{__("price")}</label>
            <div class="controls">
            <input type="text" name="price" id="elm_price" value="RRP" size="25" class="input-long" /></div>
        </div>

        <div class="control-group">
            <label class="control-label">{__("select_file")}:</label>
            <div class="controls">{include file="common/fileuploader.tpl" var_name="yml_file[0]"}</div>
        </div>

    </div>

</div>

<div  class="hidden" id="content_import_urls">

    {include file="addons/db_yml_import/views/yml_import/components/imports.tpl"}

</div>
{/capture}
{include file="common/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$smarty.request.selected_section track=true}

{capture name="buttons"}
    {include file="buttons/button.tpl" but_text=__("save") but_name="dispatch[yml_import.save]" but_role="submit-link" but_target_form="yml_import_form" but_meta="cm-tab-tools"}
    {include file="buttons/button.tpl" but_text=__("import") but_name="dispatch[yml_import.import]" but_role="submit-link" but_target_form="yml_import_form" but_meta="cm-tab-tools"}
{/capture}
    
</form>

{/capture}

{notes}
    {__("yml_import.manage.notes")}
{/notes}

{include file="common/mainbox.tpl" title=__('yml_import.title') content=$smarty.capture.mainbox buttons=$smarty.capture.buttons}


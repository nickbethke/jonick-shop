<?php

require_once __DIR__ . '/admin.php';

admin_page_head('cms-edit', 'CMS Edit');
$page = get_cms_page_by("ID", $_GET['id']);

?>
<input type="text" name="title" id="page_title" placeholder="Title" class="border p-2 w-full mt-3 text-3xl" value="<?php echo $page->get_prop('title') ?>">
<div class="my-2"></div>
<textarea name="" id="content-editor" cols="10" rows="3" placeholder="Content" class="hidden"><?php echo $page->get_prop('content') ?></textarea>
<script>
    window.onload = () => {
        tinymce.init({
            selector: '#content-editor',
            menubar: false,
            plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable export',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect | fontsizeselect | formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
            toolbar_sticky: true,
            height: 600,
            toolbar_mode: 'sliding',
            contextmenu: 'link image imagetools table',
            skin: 'oxide-dark'
        });
    }
</script>
<?php


admin_page_footer('cms-edit', ['cms-edit', 'media-overlay'], ['tinymce']);

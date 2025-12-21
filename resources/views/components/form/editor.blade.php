@props([
    'name' => 'content',
    'value' => old($name, $value ?? ''),
    'locale' => app()->getLocale(),
    'saveImagesAs' => 'base64',
    'id' => null,
    'label' => null,
    'required' => false,
    'error' => null,
])
@php
    $editorId = $id ?? 'editor-' . Str::random(8);
    // Очищаем значение от лишних пробелов, но сохраняем HTML
    $cleanValue = trim($value);
    if (empty($cleanValue)) {
        $cleanValue = '<p><br></p>';
    }
@endphp
<div class="wysiwyg w-full" data-wysiwyg-id="{{ $editorId }}" data-locale="{{ $locale }}"
    data-save-images-as="{{ $saveImagesAs }}">
    <div class="wysiwyg-toolbar flex flex-wrap items-center gap-1">
        <button type="button" onclick="wysiwygFormat(event, 'undo')" data-i18n-title="undo" title="Undo">
            <i class="fa-solid fa-rotate-left"></i>
        </button>
        <button type="button" onclick="wysiwygFormat(event, 'redo')" data-i18n-title="redo" title="Redo">
            <i class="fa-solid fa-rotate-right"></i>
        </button>
        <span class="wysiwyg-divider"></span>
        <button type="button" onclick="wysiwygFormat(event, 'bold')" data-i18n-title="bold" title="Bold">
            <i class="fa-solid fa-bold"></i>
        </button>
        <button type="button" onclick="wysiwygFormat(event, 'italic')" data-i18n-title="italic" title="Italic">
            <i class="fa-solid fa-italic"></i>
        </button>
        <button type="button" onclick="wysiwygFormat(event, 'underline')" data-i18n-title="underline"
            title="Underline">
            <i class="fa-solid fa-underline"></i>
        </button>
        <button type="button" onclick="wysiwygFormat(event, 'strikethrough')" data-i18n-title="strikethrough"
            title="Strikethrough">
            <i class="fa-solid fa-strikethrough"></i>
        </button>
        <button type="button" onclick="wysiwygHighlightText(event)" data-i18n-title="highlight" title="Highlight">
            <i class="fa-solid fa-highlighter"></i>
        </button>
        <span class="wysiwyg-divider"></span>
        <select class="wysiwyg-select wysiwyg-heading-select"
            onchange="wysiwygSetHeading(event, this.value); this.value=''" title="Heading">
            <option value="" data-i18n="text">Text</option>
            <option value="H1">H1</option>
            <option value="H2">H2</option>
            <option value="H3">H3</option>
            <option value="H4">H4</option>
            <option value="H5">H5</option>
            <option value="H6">H6</option>
        </select>
        <span class="wysiwyg-divider"></span>
        <button type="button" onclick="wysiwygFormat(event, 'insertUnorderedList')" data-i18n-title="bulletList"
            title="Bullet List">
            <i class="fa-solid fa-list-ul"></i>
        </button>
        <button type="button" onclick="wysiwygFormat(event, 'insertOrderedList')" data-i18n-title="numberedList"
            title="Numbered List">
            <i class="fa-solid fa-list-ol"></i>
        </button>
        <span class="wysiwyg-divider"></span>
        <button type="button" onclick="wysiwygIndent(event, 'outdent')" data-i18n-title="outdent" title="Outdent">
            <i class="fa-solid fa-outdent"></i>
        </button>
        <button type="button" onclick="wysiwygIndent(event, 'indent')" data-i18n-title="indent" title="Indent">
            <i class="fa-solid fa-indent"></i>
        </button>
        <span class="wysiwyg-divider"></span>
        <button type="button" onclick="wysiwygAlignText(event, 'left')" data-i18n-title="alignLeft" title="Align Left">
            <i class="fa-solid fa-align-left"></i>
        </button>
        <button type="button" onclick="wysiwygAlignText(event, 'center')" data-i18n-title="alignCenter"
            title="Align Center">
            <i class="fa-solid fa-align-center"></i>
        </button>
        <button type="button" onclick="wysiwygAlignText(event, 'right')" data-i18n-title="alignRight"
            title="Align Right">
            <i class="fa-solid fa-align-right"></i>
        </button>
        <button type="button" onclick="wysiwygAlignText(event, 'justify')" data-i18n-title="alignJustify"
            title="Justify">
            <i class="fa-solid fa-align-justify"></i>
        </button>
        <span class="wysiwyg-divider"></span>
        <button type="button" onclick="wysiwygToggleScript(event, 'superscript')" data-i18n-title="superscript"
            title="Superscript">
            <i class="fa-solid fa-superscript"></i>
        </button>
        <button type="button" onclick="wysiwygToggleScript(event, 'subscript')" data-i18n-title="subscript"
            title="Subscript">
            <i class="fa-solid fa-subscript"></i>
        </button>
        <span class="wysiwyg-divider"></span>
        <button type="button" onclick="wysiwygInsertBlock(event, 'code')" data-i18n-title="code"
            title="Code Block">
            <i class="fa-solid fa-code"></i>
        </button>
        <button type="button" onclick="wysiwygInsertBlock(event, 'note')" data-i18n-title="note"
            title="Note Block">
            <i class="fa-solid fa-quote-left"></i>
        </button>
        <button type="button" onclick="wysiwygInsertHR(event)" data-i18n-title="horizontalRule"
            title="Horizontal Line">
            <i class="fa-solid fa-minus"></i>
        </button>
        <span class="wysiwyg-divider"></span>
        <button type="button" onclick="wysiwygOpenLinkModal(event)" data-i18n-title="link" title="Insert Link">
            <i class="fa-solid fa-link"></i>
        </button>
        <button type="button" onclick="wysiwygOpenFileUpload(event)" data-i18n-title="imageFile"
            title="Insert Image">
            <i class="fa-solid fa-image"></i>
        </button>
        <button type="button" onclick="wysiwygFormat(event, 'removeFormat')" data-i18n-title="clearFormat"
            title="Clear Format">
            <i class="fa-solid fa-eraser"></i>
        </button>
        <span class="wysiwyg-divider"></span>
        <button type="button" onclick="wysiwygClearAll(event)" data-i18n-title="clearAll"
            class="wysiwyg-danger-btn" title="Clear All">
            <i class="fa-solid fa-trash"></i>
        </button>
    </div>

    {{-- ВАЖНО: Контент вставляется напрямую в редактор с HTML разметкой --}}
    <div contenteditable="true" class="wysiwyg-editor" id="{{ $editorId }}" oninput="wysiwygSyncContent(this)"
        onfocus="wysiwygEditorFocus(this)" onblur="wysiwygEditorBlur(this)">{!! $cleanValue !!}</div>

    <div class="wysiwyg-status-bar">
        <span class="wysiwyg-status-item">
            <i class="fa-solid fa-file-lines"></i>
            <span class="wysiwyg-word-count" data-i18n-pattern="words">0 words</span>
        </span>
        <span class="wysiwyg-status-item">
            <i class="fa-solid fa-keyboard"></i>
            <span class="wysiwyg-char-count" data-i18n-pattern="characters">0 characters</span>
        </span>
        <span class="wysiwyg-status-item wysiwyg-current-block">
            <i class="fa-solid fa-paragraph"></i>
            <span data-i18n="paragraph">Paragraph</span>
        </span>
    </div>

    {{-- ВАЖНО: Скрытое поле ПУСТОЕ при загрузке, заполняется JavaScript'ом --}}
    <input type="hidden" name="{{ $name }}" value="" data-wysiwyg-hidden
        @if ($required) required @endif>

    <input type="file" class="wysiwyg-file-input" style="display: none;"
        accept="image/*,application/pdf,.doc,.docx,.txt" onchange="wysiwygHandleFileSelect(event)">
</div>

<div class="wysiwyg-modal" id="wysiwygUniversalModal">
    <div class="wysiwyg-modal-overlay" onclick="wysiwygCloseUniversalModal()"></div>
    <div class="wysiwyg-modal-content">
        <div class="wysiwyg-modal-header">
            <h3 id="wysiwygModalTitle" data-i18n="insert">Insert</h3>
            <button type="button" class="wysiwyg-modal-close" onclick="wysiwygCloseUniversalModal()">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
        <div class="wysiwyg-modal-body">
            <div class="wysiwyg-file-preview" id="wysiwygModalPreview" style="display:none;">
                <img id="wysiwygModalImagePreview" style="display:none; max-width:100%; height:auto;">
                <div id="wysiwygModalFileInfo" style="display:none;">
                    <i class="fa-solid fa-file"></i>
                    <span id="wysiwygModalFileName"></span>
                </div>
            </div>
            <div class="wysiwyg-form-group">
                <label data-i18n="url">URL</label>
                <input type="text" id="wysiwygModalUrl" class="wysiwyg-input">
            </div>
            <div class="wysiwyg-form-group" id="modalTextGroup">
                <label id="modalTextLabel" data-i18n="text">Text</label>
                <input type="text" id="wysiwygModalText" class="wysiwyg-input">
            </div>
            <div class="wysiwyg-form-group" id="modalTargetGroup">
                <label>
                    <input type="checkbox" id="wysiwygModalTarget">
                    <span data-i18n="openInNewTab">Open in new tab</span>
                </label>
            </div>
            <div class="wysiwyg-form-group" id="modalAlignGroup" style="display:none;">
                <label data-i18n="alignment">Alignment</label>
                <div class="wysiwyg-align-buttons">
                    <button type="button" class="wysiwyg-align-btn active" data-align="left"
                        data-i18n="left">Left</button>
                    <button type="button" class="wysiwyg-align-btn" data-align="center"
                        data-i18n="center">Center</button>
                    <button type="button" class="wysiwyg-align-btn" data-align="right"
                        data-i18n="right">Right</button>
                </div>
            </div>
            <div class="wysiwyg-form-group" id="modalDeleteGroup" style="display:none;">
                <button type="button" class="wysiwyg-btn wysiwyg-danger-btn" onclick="wysiwygDeleteLink()"
                    data-i18n="deleteLink">
                    Delete link
                </button>
            </div>
            <div class="wysiwyg-form-group" id="modalDeleteImageGroup" style="display:none;">
                <button type="button" class="wysiwyg-btn wysiwyg-danger-btn" onclick="wysiwygDeleteImage()"
                    data-i18n="deleteImage">
                    Delete image
                </button>
            </div>
        </div>
        <div class="wysiwyg-modal-footer">
            <button type="button" class="wysiwyg-btn wysiwyg-btn-secondary" onclick="wysiwygCloseUniversalModal()"
                data-i18n="cancel">Cancel</button>
            <button type="button" class="wysiwyg-btn wysiwyg-btn-primary" onclick="wysiwygApplyUniversal()"
                data-i18n="apply">Apply</button>
        </div>
    </div>
</div>
<style>
    :root {
        --wysiwyg-primary: #72e3ad;
        --wysiwyg-primary-foreground: #ffffff;
        --wysiwyg-card: #fcfcfc;
        --wysiwyg-foreground: #1a1a1a;
        --wysiwyg-muted: #6b6b6b;
        --wysiwyg-muted-foreground: #4a4a4a;
        --wysiwyg-border: #d3d3d3;
        --wysiwyg-accent: #e8e8e8;
        --wysiwyg-ring: #72e3ad;
        --wysiwyg-danger: #ca3214;
        --wysiwyg-code-bg: #eaeef0;
        --wysiwyg-code-foreground: #0969da;
        --wysiwyg-overlay-bg: rgba(0, 0, 0, 0.45);
        --wysiwyg-radius-xs: 2px;
        --wysiwyg-radius-sm: 4px;
        --wysiwyg-radius-md: 6px;
        --wysiwyg-radius-lg: 10px;
        --wysiwyg-font-sans: Outfit, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        --wysiwyg-font-mono: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
        --wysiwyg-space-1: 0.25rem;
        --wysiwyg-space-2: 0.5rem;
        --wysiwyg-space-3: 0.75rem;
        --wysiwyg-space-4: 1rem;
        --wysiwyg-shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
        --wysiwyg-shadow-md: 0 4px 12px rgba(0, 0, 0, 0.15);
        --wysiwyg-shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.25);
        --wysiwyg-transition-fast: 0.15s ease;
        --wysiwyg-transition-base: 0.2s ease;
        --wysiwyg-z-modal: 10000;
    }

    .dark {
        --wysiwyg-primary: #4ade80;
        --wysiwyg-primary-foreground: #1e2723;
        --wysiwyg-card: #171717;
        --wysiwyg-foreground: #e2e8f0;
        --wysiwyg-muted: #a2a2a2;
        --wysiwyg-muted-foreground: #c0c0c0;
        --wysiwyg-border: #292929;
        --wysiwyg-accent: #313131;
        --wysiwyg-ring: #4ade80;
        --wysiwyg-danger: #ff6347;
        --wysiwyg-code-bg: #0d1117;
        --wysiwyg-code-foreground: #58a6ff;
        --wysiwyg-overlay-bg: rgba(0, 0, 0, 0.6);
    }

    .wysiwyg-toolbar {
        background: var(--wysiwyg-card);
        border: 1px solid var(--wysiwyg-border);
        border-radius: var(--wysiwyg-radius-md) var(--wysiwyg-radius-md) 0 0;
        padding: 0.5rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.25rem;
    }

    .wysiwyg.wysiwyg-active .wysiwyg-toolbar {
        border-color: var(--wysiwyg-ring);
    }

    .wysiwyg-toolbar button {
        width: 2rem;
        height: 2rem;
        border: none;
        background: transparent;
        border-radius: var(--wysiwyg-radius-sm);
        color: var(--wysiwyg-muted);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all var(--wysiwyg-transition-fast);
    }

    .wysiwyg-toolbar button:hover {
        background: var(--wysiwyg-accent);
        color: var(--wysiwyg-foreground);
    }

    .wysiwyg-toolbar button.active {
        background: var(--wysiwyg-primary);
        color: white;
    }

    .wysiwyg-danger-btn:hover {
        background: var(--wysiwyg-danger) !important;
        color: white !important;
    }

    .wysiwyg-divider {
        width: 1px;
        height: 1.5rem;
        background: var(--wysiwyg-border);
        margin: 0 0.25rem;
    }

    .wysiwyg-select {
        height: 2rem;
        padding: 0 0.5rem;
        border-radius: var(--wysiwyg-radius-sm);
        background: var(--wysiwyg-card);
        border: 1px solid var(--wysiwyg-border);
        color: var(--wysiwyg-foreground);
        font-size: 0.75rem;
        cursor: pointer;
    }

    .wysiwyg-editor {
        background: var(--wysiwyg-card);
        border: 1px solid var(--wysiwyg-border);
        border-top: none;
        border-bottom: none;
        padding: 1rem;
        min-height: 300px;
        line-height: 1.7;
        font-size: 0.875rem;
    }

    .wysiwyg-editor:focus {
        outline: none;
    }

    .wysiwyg.wysiwyg-active .wysiwyg-editor {
        border-color: var(--wysiwyg-ring);
    }

    .wysiwyg-status-bar {
        background: var(--wysiwyg-card);
        border: 1px solid var(--wysiwyg-border);
        border-radius: 0 0 var(--wysiwyg-radius-md) var(--wysiwyg-radius-md);
        padding: 0.5rem 1rem;
        display: flex;
        gap: 1.5rem;
        font-size: 0.75rem;
        color: var(--wysiwyg-muted);
        clear: both;
    }

    .wysiwyg.wysiwyg-active .wysiwyg-status-bar {
        border-color: var(--wysiwyg-ring);
    }

    .wysiwyg-status-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .wysiwyg-editor h1 {
        font-size: 1.875rem;
        font-weight: 700;
        margin: 1.5rem 0 1rem;
    }

    .wysiwyg-editor h2 {
        font-size: 1.5rem;
        font-weight: 600;
        margin: 1.25rem 0 0.75rem;
    }

    .wysiwyg-editor h3 {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 1rem 0 0.5rem;
    }

    .wysiwyg-editor pre {
        background: var(--wysiwyg-code-bg);
        color: var(--wysiwyg-code-foreground);
        padding: 1rem;
        border-radius: var(--wysiwyg-radius-sm);
        font-family: var(--wysiwyg-font-mono);
        margin: 1rem 0;
        overflow-x: auto;
    }

    .wysiwyg-editor blockquote[data-note] {
        margin: 1rem 0;
        padding: 0.75rem 1rem;
        border-left: 4px solid var(--wysiwyg-primary);
        background: color-mix(in srgb, var(--wysiwyg-primary) 8%, transparent);
        border-radius: var(--wysiwyg-radius-sm);
    }

    .wysiwyg-editor hr {
        border: none;
        border-top: 2px solid var(--wysiwyg-border);
        margin: 1.5rem 0;
    }

    .wysiwyg-editor ul,
    .wysiwyg-editor ol {
        margin: 0 0 1rem 1.5rem;
        padding-left: 0;
    }

    .wysiwyg-editor ul {
        list-style-type: disc;
    }

    .wysiwyg-editor ol {
        list-style-type: decimal;
    }

    .wysiwyg-image-wrapper {
        margin: 1rem 0;
        display: inline-block;
        max-width: 100%;
        position: relative;
        cursor: pointer;
        transition: all var(--wysiwyg-transition-base);
    }

    .wysiwyg-image-wrapper:hover {
        opacity: 0.9;
    }

    .wysiwyg-image-wrapper:hover::after {
        content: '✎ Edit';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: var(--wysiwyg-radius-sm);
        font-size: 0.875rem;
        pointer-events: none;
    }

    .wysiwyg-image-wrapper.align-left {
        float: left;
        margin-right: 1rem;
    }

    .wysiwyg-image-wrapper.align-center {
        display: block;
        text-align: center;
        margin: 1rem auto;
    }

    .wysiwyg-image-wrapper.align-right {
        float: right;
        margin-left: 1rem;
    }

    .wysiwyg-image-wrapper img {
        max-width: 100%;
        height: auto;
        border-radius: var(--wysiwyg-radius-sm);
        display: block;
    }

    .wysiwyg-modal {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: var(--wysiwyg-z-modal);
        display: none;
        align-items: center;
        justify-content: center;
    }

    .wysiwyg-modal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: var(--wysiwyg-overlay-bg);
    }

    .wysiwyg-modal-content {
        position: relative;
        background: var(--wysiwyg-card);
        border-radius: var(--wysiwyg-radius-md);
        box-shadow: var(--wysiwyg-shadow-lg);
        max-width: 500px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
    }

    .wysiwyg-modal-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--wysiwyg-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .wysiwyg-input {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid var(--wysiwyg-border);
        border-radius: var(--wysiwyg-radius-sm);
        background: var(--wysiwyg-card);
        color: var(--wysiwyg-foreground);
        font-size: 0.875rem;
    }

    .wysiwyg-btn {
        padding: 0.5rem 1rem;
        border-radius: var(--wysiwyg-radius-sm);
        font-size: 0.875rem;
        cursor: pointer;
        border: none;
    }

    .wysiwyg-btn-primary {
        background: var(--wysiwyg-primary);
        color: white;
    }

    .wysiwyg-btn-primary:hover {
        background: color-mix(in srgb, var(--wysiwyg-primary) 90%, black);
    }

    .wysiwyg-form-group {
        margin-bottom: 1rem;
    }

    .wysiwyg-modal-body {
        padding: 1.5rem;
    }

    .wysiwyg-modal-footer {
        padding: 1.5rem;
        border-top: 1px solid var(--wysiwyg-border);
        display: flex;
        gap: 0.5rem;
        justify-content: flex-end;
    }

    .wysiwyg-btn-secondary {
        background: var(--wysiwyg-accent);
        color: var(--wysiwyg-foreground);
    }

    .wysiwyg-align-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .wysiwyg-align-btn {
        padding: 0.5rem 1rem;
        border: 1px solid var(--wysiwyg-border);
        background: var(--wysiwyg-card);
        color: var(--wysiwyg-foreground);
        cursor: pointer;
        border-radius: var(--wysiwyg-radius-sm);
    }

    .wysiwyg-align-btn.active {
        background: var(--wysiwyg-primary);
        color: white;
        border-color: var(--wysiwyg-primary);
    }
</style>
<script>
    const WYSIWYG_I18N = {
        en: {
            undo: 'Undo (Ctrl+Z)', redo: 'Redo (Ctrl+Y)', bold: 'Bold (Ctrl+B)', italic: 'Italic (Ctrl+I)',
            underline: 'Underline (Ctrl+U)', strikethrough: 'Strikethrough', highlight: 'Highlight', text: 'Text',
            bulletList: 'Bullet list', numberedList: 'Numbered list', outdent: 'Outdent', indent: 'Indent',
            alignLeft: 'Align left', alignCenter: 'Align center', alignRight: 'Align right', alignJustify: 'Justify',
            superscript: 'Superscript', subscript: 'Subscript', code: 'Code block', note: 'Note block',
            horizontalRule: 'Horizontal rule', link: 'Insert link', imageFile: 'Insert image/file',
            clearFormat: 'Clear formatting', clearAll: 'Clear all', insert: 'Insert', url: 'URL',
            openInNewTab: 'Open in new tab', alignment: 'Alignment', left: 'Left', center: 'Center', right: 'Right',
            deleteLink: 'Delete link', deleteImage: 'Delete image', cancel: 'Cancel', apply: 'Apply',
            insertImage: 'Insert image', insertFile: 'Insert file', editLink: 'Edit link', editImage: 'Edit image',
            words: '{count} word{s}', characters: '{count} character{s}', paragraph: 'Paragraph', block: 'Block',
            heading1: 'Heading 1', heading2: 'Heading 2', heading3: 'Heading 3', heading4: 'Heading 4',
            heading5: 'Heading 5', heading6: 'Heading 6', codeBlock: 'Code', noteBlock: 'Note', list: 'List',
            numberedListBlock: 'Numbered List', listItem: 'List Item', clearAllConfirm: 'Are you sure you want to clear all content?'
        },
        ru: {
            undo: 'Отменить (Ctrl+Z)', redo: 'Повторить (Ctrl+Y)', bold: 'Жирный (Ctrl+B)', italic: 'Курсив (Ctrl+I)',
            underline: 'Подчеркнутый (Ctrl+U)', strikethrough: 'Зачеркнутый', highlight: 'Выделить', text: 'Текст',
            bulletList: 'Маркированный список', numberedList: 'Нумерованный список', outdent: 'Уменьшить отступ',
            indent: 'Увеличить отступ', alignLeft: 'По левому краю', alignCenter: 'По центру', alignRight: 'По правому краю',
            alignJustify: 'По ширине', superscript: 'Надстрочный', subscript: 'Подстрочный', code: 'Блок кода',
            note: 'Блок заметки', horizontalRule: 'Горизонтальная линия', link: 'Вставить ссылку',
            imageFile: 'Вставить изображение/файл', clearFormat: 'Очистить форматирование', clearAll: 'Очистить все',
            insert: 'Вставить', url: 'URL', openInNewTab: 'Открыть в новой вкладке', alignment: 'Выравнивание',
            left: 'Слева', center: 'По центру', right: 'Справа', deleteLink: 'Удалить ссылку', deleteImage: 'Удалить изображение',
            cancel: 'Отмена', apply: 'Применить', insertImage: 'Вставить изображение', insertFile: 'Вставить файл',
            editLink: 'Редактировать ссылку', editImage: 'Редактировать изображение', words: '{count} слов{s}',
            characters: '{count} символ{s}', paragraph: 'Параграф', block: 'Блок', heading1: 'Заголовок 1',
            heading2: 'Заголовок 2', heading3: 'Заголовок 3', heading4: 'Заголовок 4', heading5: 'Заголовок 5',
            heading6: 'Заголовок 6', codeBlock: 'Код', noteBlock: 'Заметка', list: 'Список',
            numberedListBlock: 'Нумерованный список', listItem: 'Элемент списка',
            clearAllConfirm: 'Вы уверены, что хотите очистить весь контент?'
        },
        uk: {
            undo: 'Скасувати (Ctrl+Z)', redo: 'Повторити (Ctrl+Y)', bold: 'Жирний (Ctrl+B)', italic: 'Курсив (Ctrl+I)',
            underline: 'Підкреслений (Ctrl+U)', strikethrough: 'Закреслений', highlight: 'Виділити', text: 'Текст',
            bulletList: 'Маркований список', numberedList: 'Нумерований список', outdent: 'Зменшити відступ',
            indent: 'Збільшити відступ', alignLeft: 'По лівому краю', alignCenter: 'По центру',
            alignRight: 'По правому краю', alignJustify: 'По ширині', superscript: 'Надрядковий', subscript: 'Підрядковий',
            code: 'Блок коду', note: 'Блок нотатки', horizontalRule: 'Горизонтальна лінія', link: 'Вставити посилання',
            imageFile: 'Вставити зображення/файл', clearFormat: 'Очистити форматування', clearAll: 'Очистити все',
            insert: 'Вставити', url: 'URL', openInNewTab: 'Відкрити в новій вкладці', alignment: 'Вирівнювання',
            left: 'Зліва', center: 'По центру', right: 'Справа', deleteLink: 'Видалити посилання',
            deleteImage: 'Видалити зображення', cancel: 'Скасувати', apply: 'Застосувати',
            insertImage: 'Вставити зображення', insertFile: 'Вставити файл', editLink: 'Редагувати посилання',
            editImage: 'Редагувати зображення', words: '{count} слів{s}', characters: '{count} символ{s}',
            paragraph: 'Параграф', block: 'Блок', heading1: 'Заголовок 1', heading2: 'Заголовок 2',
            heading3: 'Заголовок 3', heading4: 'Заголовок 4', heading5: 'Заголовок 5', heading6: 'Заголовок 6',
            codeBlock: 'Код', noteBlock: 'Нотатка', list: 'Список', numberedListBlock: 'Нумерований список',
            listItem: 'Елемент списку', clearAllConfirm: 'Ви впевнені, що хочете очистити весь контент?'
        }
    };

    const WC = {
        blocks: ['P', 'DIV', 'H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'BLOCKQUOTE', 'PRE', 'LI'],
        headings: ['H1', 'H2', 'H3', 'H4', 'H5', 'H6'],
        names: {
            P: 'paragraph', DIV: 'block', H1: 'heading1', H2: 'heading2', H3: 'heading3', H4: 'heading4',
            H5: 'heading5', H6: 'heading6', PRE: 'codeBlock', BLOCKQUOTE: 'noteBlock', UL: 'list',
            OL: 'numberedListBlock', LI: 'listItem'
        },
        align: { left: 'left', start: 'left', center: 'center', right: 'right', end: 'right', justify: 'justify' },
        editor: null, file: null, mode: null, link: null, range: null, imageWrapper: null, locale: 'en', saveImagesAs: 'url'
    };

    function t(key, params = {}) {
        const locale = WC.locale || 'en';
        const translations = WYSIWYG_I18N[locale] || WYSIWYG_I18N.en;
        let text = translations[key] || WYSIWYG_I18N.en[key] || key;
        Object.keys(params).forEach(k => { text = text.replace(`{${k}}`, params[k]); });
        return text;
    }

    function applyI18n(container) {
        container.querySelectorAll('[data-i18n]').forEach(el => { el.textContent = t(el.getAttribute('data-i18n')); });
        container.querySelectorAll('[data-i18n-title]').forEach(el => { el.title = t(el.getAttribute('data-i18n-title')); });
    }

    function getEd(e) {
        let tg = e.target;
        while (tg && !tg.hasAttribute('data-wysiwyg-id')) tg = tg.parentElement;
        return tg?.querySelector('.wysiwyg-editor');
    }

    function findP(n, tag, stop) {
        while (n && n !== stop) {
            if (n.nodeType === 1 && n.nodeName === tag) return n;
            n = n.parentNode;
        }
        return null;
    }

    function isInside(r, fn, stop) {
        let n = r.startContainer;
        while (n && n !== stop) {
            if (n.nodeType === 1 && fn(n)) return n;
            n = n.parentNode;
        }
        return null;
    }

    function moveCaret(el, txt = '\u00A0') {
        const tn = document.createTextNode(txt);
        el.parentNode.insertBefore(tn, el.nextSibling);
        const s = window.getSelection(), r = document.createRange();
        r.setStart(tn, 1);
        r.collapse(true);
        s.removeAllRanges();
        s.addRange(r);
    }

    function setCaret(el) {
        const r = document.createRange(), s = window.getSelection();
        r.selectNodeContents(el);
        r.collapse(true);
        s.removeAllRanges();
        s.addRange(r);
    }

    function fileToBase64(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = () => resolve(reader.result);
            reader.onerror = reject;
            reader.readAsDataURL(file);
        });
    }

    function wysiwygSyncContent(ed) {
        const c = ed.closest('.wysiwyg'), h = c?.querySelector('input[type="hidden"][data-wysiwyg-hidden]');
        if (h) h.value = ed.innerHTML;
        const txt = ed.innerText || '', w = txt.trim().split(/\s+/).filter(x => x.length).length, ch = txt.length;
        const wc = c.querySelector('.wysiwyg-word-count'), cc = c.querySelector('.wysiwyg-char-count');
        if (wc) wc.textContent = t('words', { count: w, s: w !== 1 ? 's' : '' });
        if (cc) cc.textContent = t('characters', { count: ch, s: ch !== 1 ? 's' : '' });
        const s = window.getSelection();
        if (s.rangeCount) {
            let n = s.getRangeAt(0).startContainer;
            while (n && n !== ed && n.nodeType !== 1) n = n.parentNode;
            while (n && n !== ed) {
                if (n.nodeType === 1 && WC.blocks.includes(n.nodeName)) {
                    const blockKey = WC.names[n.nodeName] || 'text';
                    c.querySelector('.wysiwyg-current-block span').textContent = t(blockKey);
                    break;
                }
                n = n.parentNode;
            }
        }
    }

    function updToolbar(ed) {
        if (!ed) return;
        const c = ed.closest('.wysiwyg');
        if (!c) return;
        c.querySelectorAll('.wysiwyg-toolbar button').forEach(b => b.classList.remove('active'));
        ['bold', 'italic', 'underline', 'strikethrough', 'insertUnorderedList', 'insertOrderedList'].forEach(cmd => {
            if (document.queryCommandState(cmd)) {
                const b = c.querySelector(`[onclick*="'${cmd}'"]`);
                if (b) b.classList.add('active');
            }
        });
        const s = window.getSelection();
        if (!s.rangeCount) return;
        let n = s.getRangeAt(0).startContainer;
        while (n && n !== ed) {
            if (n.nodeType === 1) {
                if (n.nodeName === 'SUP') c.querySelector('[onclick*="wysiwygToggleScript"][onclick*="superscript"]')?.classList.add('active');
                if (n.nodeName === 'SUB') c.querySelector('[onclick*="wysiwygToggleScript"][onclick*="subscript"]')?.classList.add('active');
            }
            n = n.parentNode;
        }
        n = s.getRangeAt(0).startContainer;
        while (n && n !== ed && n.nodeType !== 1) n = n.parentNode;
        while (n && n !== ed && !WC.blocks.includes(n.nodeName)) n = n.parentNode;
        if (n && n !== ed) {
            const sel = c.querySelector('.wysiwyg-heading-select');
            if (sel) sel.value = WC.headings.includes(n.nodeName) ? n.nodeName : '';
            let al = window.getComputedStyle(n).textAlign;
            if ((n.nodeName === 'BLOCKQUOTE' || n.nodeName === 'PRE') && n.querySelector('div'))
                al = window.getComputedStyle(n.querySelector('div')).textAlign;
            const ma = WC.align[al];
            if (ma) c.querySelector(`[onclick*="wysiwygAlignText"][onclick*="'${ma}'"]`)?.classList.add('active');
        }
        if (findP(s.anchorNode, 'A', ed)) c.querySelector('[onclick*="wysiwygOpenLinkModal"]')?.classList.add('active');
        if (findP(s.anchorNode, 'PRE', ed)?.hasAttribute('data-code'))
            c.querySelector('[onclick*="wysiwygInsertBlock"][onclick*="code"]')?.classList.add('active');
        if (findP(s.anchorNode, 'BLOCKQUOTE', ed)?.hasAttribute('data-note'))
            c.querySelector('[onclick*="wysiwygInsertBlock"][onclick*="note"]')?.classList.add('active');
        if (isInside(s.getRangeAt(0), n => {
            const bg = window.getComputedStyle(n).backgroundColor;
            return bg === 'rgb(255, 255, 0)' || bg === 'yellow';
        }, ed)) c.querySelector('[onclick*="wysiwygHighlightText"]')?.classList.add('active');
    }

    function wysiwygFormat(e, cmd, v = null) {
        const ed = getEd(e);
        if (ed) {
            ed.focus();
            document.execCommand(cmd, false, v);
            wysiwygSyncContent(ed);
            updToolbar(ed);
        }
    }

    function wysiwygSetHeading(e, tag) {
        if (tag) wysiwygFormat(e, 'formatBlock', tag);
    }

    function wysiwygHighlightText(e) {
        const ed = getEd(e);
        if (!ed) return;
        ed.focus();
        const s = window.getSelection();
        if (!s.rangeCount) return;
        const r = s.getRangeAt(0), h = isInside(r, n => {
            const bg = window.getComputedStyle(n).backgroundColor;
            return bg === 'rgb(255, 255, 0)' || bg === 'yellow';
        }, ed);
        if (h && r.collapsed) moveCaret(h);
        else if (h) {
            document.execCommand('removeFormat', false, null);
            document.execCommand('hiliteColor', false, 'transparent');
        } else document.execCommand('hiliteColor', false, 'yellow');
        wysiwygSyncContent(ed);
        updToolbar(ed);
    }

    function unwrapElement(el) {
        const parent = el.parentNode;
        while (el.firstChild) parent.insertBefore(el.firstChild, el);
        parent.removeChild(el);
    }

    function wysiwygToggleScript(e, type) {
        const ed = getEd(e);
        if (!ed) return;
        ed.focus();
        const s = window.getSelection();
        if (!s.rangeCount) return;
        const r = s.getRangeAt(0), tag = type === 'superscript' ? 'SUP' : 'SUB', el = findP(r.startContainer, tag, ed);
        if (el) {
            if (r.collapsed) moveCaret(el);
            else {
                const range = r.cloneRange();
                unwrapElement(el);
                s.removeAllRanges();
                s.addRange(range);
            }
        } else document.execCommand(type, false, null);
        wysiwygSyncContent(ed);
        updToolbar(ed);
    }

    function wysiwygInsertBlock(e, type) {
        const ed = getEd(e);
        if (!ed) return;
        ed.focus();
        const s = window.getSelection();
        if (!s.rangeCount) return;
        const r = s.getRangeAt(0);
        let b;
        if (type === 'code') {
            b = document.createElement('pre');
            b.setAttribute('data-code', 'true');
            b.textContent = '';
        } else {
            b = document.createElement('blockquote');
            b.setAttribute('data-note', 'true');
            b.innerHTML = '<div><br></div>';
        }
        let cb = r.startContainer;
        while (cb && cb.nodeType !== 1) cb = cb.parentNode;
        while (cb && cb !== ed && /^(H[1-6]|P|DIV|BLOCKQUOTE)$/.test(cb.tagName)) {
            if (cb.parentNode === ed) break;
            cb = cb.parentNode;
        }
        const np = document.createElement('p');
        np.innerHTML = '<br>';
        if (cb && cb.parentNode === ed) {
            cb.parentNode.insertBefore(np, cb.nextSibling);
            cb.parentNode.insertBefore(b, np);
        } else {
            r.deleteContents();
            r.insertNode(np);
            r.insertNode(b);
        }
        setCaret(type === 'note' ? b.firstChild : b);
        wysiwygSyncContent(ed);
        updToolbar(ed);
    }

    function wysiwygInsertHR(e) {
        const ed = getEd(e);
        if (ed) {
            ed.focus();
            document.execCommand('insertHorizontalRule', false, null);
            wysiwygSyncContent(ed);
        }
    }

    function wysiwygIndent(e, d) {
        const ed = getEd(e);
        if (!ed) return;
        ed.focus();
        const s = window.getSelection();
        if (!s.rangeCount) return;
        let n = s.focusNode;
        while (n && n !== ed) {
            if (n.nodeType === 1 && ['P', 'DIV', 'H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'BLOCKQUOTE', 'LI'].includes(n.nodeName) && ed.contains(n)) {
                const m = parseInt(window.getComputedStyle(n).marginLeft) || 0;
                n.style.marginLeft = (d === 'indent' ? m + 30 : Math.max(0, m - 30)) + 'px';
                wysiwygSyncContent(ed);
                return;
            }
            n = n.parentNode;
        }
    }

    function wysiwygAlignText(e, a) {
        const ed = getEd(e);
        if (!ed) return;
        ed.focus();
        const s = window.getSelection();
        if (!s.rangeCount || !ed.contains(s.anchorNode)) return;
        const r = s.getRangeAt(0), bs = new Set(), w = document.createTreeWalker(ed, NodeFilter.SHOW_ELEMENT, {
            acceptNode(n) {
                if (WC.blocks.includes(n.nodeName)) {
                    const nr = document.createRange();
                    nr.selectNodeContents(n);
                    if (r.compareBoundaryPoints(Range.END_TO_START, nr) < 0 && r.compareBoundaryPoints(Range.START_TO_END, nr) > 0) return NodeFilter.FILTER_ACCEPT;
                }
                return NodeFilter.FILTER_SKIP;
            }
        });
        let n = w.nextNode();
        while (n) { bs.add(n); n = w.nextNode(); }
        if (bs.size === 0) {
            n = r.startContainer;
            while (n && n !== ed && !WC.blocks.includes(n.nodeName)) n = n.parentNode;
            if (n && n !== ed) bs.add(n);
        }
        bs.forEach(b => b.style.textAlign = a);
        wysiwygSyncContent(ed);
        updToolbar(ed);
    }

    function wysiwygClearAll(e) {
        const ed = getEd(e);
        if (ed && confirm(t('clearAllConfirm'))) {
            ed.innerHTML = '<p><br></p>';
            ed.focus();
            wysiwygSyncContent(ed);
            updToolbar(ed);
        }
    }

    function wysiwygEditorFocus(ed) {
        document.querySelectorAll('.wysiwyg').forEach(w => w.classList.remove('wysiwyg-active'));
        ed.closest('.wysiwyg')?.classList.add('wysiwyg-active');
        updToolbar(ed);
        wysiwygSyncContent(ed);
    }

    function wysiwygEditorBlur(ed) {
        setTimeout(() => {
            const c = ed.closest('.wysiwyg');
            if (c && !c.contains(document.activeElement)) c.classList.remove('wysiwyg-active');
        }, 100);
    }

    function showM(titleKey, cfg) {
        document.getElementById('wysiwygModalTitle').textContent = t(titleKey);
        document.getElementById('modalTextGroup').style.display = cfg.txt ? 'block' : 'none';
        document.getElementById('modalTargetGroup').style.display = cfg.tgt ? 'block' : 'none';
        document.getElementById('modalAlignGroup').style.display = cfg.aln ? 'block' : 'none';
        document.getElementById('modalDeleteGroup').style.display = cfg.del ? 'block' : 'none';
        document.getElementById('modalDeleteImageGroup').style.display = cfg.delImg ? 'block' : 'none';
        document.getElementById('wysiwygModalPreview').style.display = cfg.prv ? 'block' : 'none';
        document.getElementById('wysiwygUniversalModal').style.display = 'flex';
    }

    function wysiwygOpenLinkModal(e) {
        const ed = getEd(e);
        if (!ed) return;
        WC.editor = ed;
        WC.mode = 'link';
        const s = window.getSelection();
        if (s.rangeCount) WC.range = s.getRangeAt(0).cloneRange();
        const lnk = s.rangeCount ? findP(s.anchorNode, 'A', ed) : null;
        WC.link = lnk;
        document.getElementById('wysiwygModalUrl').value = lnk?.href || '';
        document.getElementById('wysiwygModalText').value = lnk?.textContent || s.toString();
        document.getElementById('wysiwygModalTarget').checked = lnk?.target === '_blank';
        showM(lnk ? 'editLink' : 'link', { txt: 1, tgt: 1, aln: 0, del: !!lnk, delImg: 0, prv: 0 });
    }

    function wysiwygOpenFileUpload(e) {
        const ed = getEd(e);
        if (!ed) return;
        WC.editor = ed;
        const s = window.getSelection();
        if (s.rangeCount) WC.range = s.getRangeAt(0).cloneRange();
        ed.closest('.wysiwyg').querySelector('.wysiwyg-file-input').click();
    }

    async function wysiwygHandleFileSelect(e) {
        const f = e.target.files[0];
        if (!f) return;
        WC.file = f;
        const isImg = f.type.startsWith('image/');
        WC.mode = isImg ? 'image' : 'file';
        const prv = document.getElementById('wysiwygModalPreview'), img = document.getElementById('wysiwygModalImagePreview'),
            inf = document.getElementById('wysiwygModalFileInfo'), nm = document.getElementById('wysiwygModalFileName');
        if (isImg) {
            const base64 = await fileToBase64(f);
            img.src = base64;
            img.style.display = 'block';
            inf.style.display = 'none';
        } else {
            img.style.display = 'none';
            inf.style.display = 'flex';
            nm.textContent = f.name;
        }
        showM(isImg ? 'insertImage' : 'insertFile', { txt: isImg, tgt: 0, aln: isImg, del: 0, delImg: 0, prv: 1 });
    }

    function wysiwygEditImage(wrapper) {
        const ed = wrapper.closest('.wysiwyg-editor');
        if (!ed) return;
        WC.editor = ed;
        WC.mode = 'image-edit';
        WC.imageWrapper = wrapper;
        const img = wrapper.querySelector('img'), cap = wrapper.querySelector('.wysiwyg-image-caption');
        const align = wrapper.classList.contains('align-left') ? 'left' :
            wrapper.classList.contains('align-right') ? 'right' : 'center';
        document.getElementById('wysiwygModalUrl').value = img.src;
        document.getElementById('wysiwygModalText').value = cap ? cap.textContent : '';
        const prv = document.getElementById('wysiwygModalPreview'), prvImg = document.getElementById('wysiwygModalImagePreview'),
            inf = document.getElementById('wysiwygModalFileInfo');
        prvImg.src = img.src;
        prvImg.style.display = 'block';
        inf.style.display = 'none';
        prv.style.display = 'block';
        document.querySelectorAll('.wysiwyg-align-btn').forEach(b => b.classList.remove('active'));
        document.querySelector(`.wysiwyg-align-btn[data-align="${align}"]`)?.classList.add('active');
        showM('editImage', { txt: 1, tgt: 0, aln: 1, del: 0, delImg: 1, prv: 1 });
    }

    function wysiwygCloseUniversalModal() {
        document.getElementById('wysiwygUniversalModal').style.display = 'none';
        const img = document.getElementById('wysiwygModalImagePreview'), inf = document.getElementById('wysiwygModalFileInfo');
        img.src = '';
        img.style.display = 'none';
        inf.style.display = 'none';
        WC.mode = WC.link = WC.file = WC.imageWrapper = null;
    }

    async function wysiwygApplyUniversal() {
        const ed = WC.editor;
        if (!ed) return;
        ed.focus();
        const s = window.getSelection();
        s.removeAllRanges();
        if (WC.range) s.addRange(WC.range);
        if (WC.mode === 'link') {
            const u = document.getElementById('wysiwygModalUrl').value.trim(),
                txt = document.getElementById('wysiwygModalText').value.trim(),
                tb = document.getElementById('wysiwygModalTarget').checked;
            if (!u) return;
            let lnk = WC.link;
            if (lnk) {
                lnk.href = u;
                lnk.textContent = txt || lnk.textContent;
                if (tb) lnk.target = '_blank';
                else lnk.removeAttribute('target');
            } else if (s.rangeCount) {
                const r = s.getRangeAt(0), a = document.createElement('a');
                a.href = u;
                a.textContent = txt || u;
                if (tb) a.target = '_blank';
                r.deleteContents();
                r.insertNode(a);
                r.setStartAfter(a);
                r.collapse(true);
                s.removeAllRanges();
                s.addRange(r);
            }
        }
        if (WC.mode === 'image-edit') {
            const w = WC.imageWrapper;
            if (!w) return;
            const cap = document.getElementById('wysiwygModalText').value.trim();
            const al = document.querySelector('.wysiwyg-align-btn.active')?.dataset.align || 'left';
            w.className = `wysiwyg-image-wrapper align-${al}`;
            let capEl = w.querySelector('.wysiwyg-image-caption');
            if (cap) {
                if (!capEl) {
                    capEl = document.createElement('div');
                    capEl.className = 'wysiwyg-image-caption';
                    w.appendChild(capEl);
                }
                capEl.textContent = cap;
            } else if (capEl) capEl.remove();
        }
        if (WC.mode === 'image') {
            const f = WC.file;
            if (!f) return;
            const cap = document.getElementById('wysiwygModalText').value.trim(),
                al = document.querySelector('.wysiwyg-align-btn.active')?.dataset.align || 'left',
                w = document.createElement('div');
            w.className = `wysiwyg-image-wrapper align-${al}`;
            w.contentEditable = 'false';
            w.onclick = function() { wysiwygEditImage(this); };
            const img = document.createElement('img');
            if (WC.saveImagesAs === 'base64') img.src = await fileToBase64(f);
            else img.src = URL.createObjectURL(f);
            img.alt = cap || 'Image';
            w.appendChild(img);
            if (cap) {
                const c = document.createElement('div');
                c.className = 'wysiwyg-image-caption';
                c.textContent = cap;
                w.appendChild(c);
            }
            if (s.rangeCount) {
                const r = s.getRangeAt(0);
                r.deleteContents();
                r.insertNode(w);
                const p = document.createElement('p');
                p.innerHTML = '<br>';
                w.parentNode.insertBefore(p, w.nextSibling);
                r.setStart(p, 0);
                r.collapse(true);
                s.removeAllRanges();
                s.addRange(r);
            } else ed.appendChild(w);
        }
        if (WC.mode === 'file') {
            const f = WC.file;
            if (!f) return;
            const a = document.createElement('a');
            a.href = URL.createObjectURL(f);
            a.download = f.name;
            a.className = 'wysiwyg-file-attachment';
            a.contentEditable = 'false';
            a.innerHTML = `<i class="fa-solid fa-file wysiwyg-file-icon"></i><div class="wysiwyg-file-info"><span class="wysiwyg-file-name">${f.name}</span><span class="wysiwyg-file-size">${(f.size/1024).toFixed(1)} KB</span></div><i class="fa-solid fa-download wysiwyg-file-download"></i>`;
            if (s.rangeCount) {
                const r = s.getRangeAt(0);
                r.deleteContents();
                const p = document.createElement('p');
                p.appendChild(a);
                r.insertNode(p);
                const np = document.createElement('p');
                np.innerHTML = '<br>';
                p.parentNode.insertBefore(np, p.nextSibling);
                r.setStart(np, 0);
                r.collapse(true);
                s.removeAllRanges();
                s.addRange(r);
            } else {
                const p = document.createElement('p');
                p.appendChild(a);
                ed.appendChild(p);
            }
        }
        wysiwygSyncContent(ed);
        wysiwygCloseUniversalModal();
    }

    function wysiwygDeleteLink() {
        const lnk = WC.link;
        if (!lnk) return;
        lnk.replaceWith(document.createTextNode(lnk.textContent));
        wysiwygSyncContent(WC.editor);
        wysiwygCloseUniversalModal();
    }

    function wysiwygDeleteImage() {
        const w = WC.imageWrapper;
        if (!w) return;
        w.remove();
        wysiwygSyncContent(WC.editor);
        wysiwygCloseUniversalModal();
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.wysiwyg').forEach(container => {
            const ed = container.querySelector('.wysiwyg-editor');
            const locale = container.getAttribute('data-locale') || 'en';
            const saveAs = container.getAttribute('data-save-images-as') || 'url';
            WC.locale = locale;
            WC.saveImagesAs = saveAs;
            applyI18n(container);
            applyI18n(document.getElementById('wysiwygUniversalModal'));
            
            // КРИТИЧЕСКИ ВАЖНО: Инициализируем скрытое поле значением из РЕДАКТОРА
            const h = container.querySelector('input[type="hidden"][data-wysiwyg-hidden]');
            if (h) h.value = ed.innerHTML;
            
            ed.querySelectorAll('.wysiwyg-image-wrapper').forEach(w => {
                w.onclick = function() { wysiwygEditImage(this); };
            });
            
            setTimeout(() => {
                updToolbar(ed);
                wysiwygSyncContent(ed);
            }, 100);
        });
        
        document.addEventListener('click', e => {
            if (e.target.closest('.wysiwyg-align-btn')) {
                const b = e.target.closest('.wysiwyg-align-btn'), c = b.closest('.wysiwyg-align-buttons');
                c.querySelectorAll('.wysiwyg-align-btn').forEach(x => x.classList.remove('active'));
                b.classList.add('active');
            }
        });
    });

    document.addEventListener('selectionchange', () => {
        const s = window.getSelection();
        if (s.rangeCount) {
            let n = s.getRangeAt(0).startContainer;
            while (n) {
                if (n.classList?.contains('wysiwyg-editor')) {
                    updToolbar(n);
                    wysiwygSyncContent(n);
                    break;
                }
                n = n.parentNode;
            }
        }
    });

    document.addEventListener('keydown', e => {
        if (e.key !== 'Enter') return;
        const s = window.getSelection();
        if (!s.rangeCount) return;
        const r = s.getRangeAt(0);
        let n = r.startContainer, ed = n;
        while (ed && !ed.classList?.contains('wysiwyg-editor')) ed = ed.parentNode;
        if (!ed?.contains(n)) return;
        let b = n;
        while (b && b !== ed) {
            if (b.nodeType === 1) {
                if (/^H[1-6]$/.test(b.tagName)) {
                    e.preventDefault();
                    const p = document.createElement('p');
                    p.innerHTML = '<br>';
                    b.parentNode.insertBefore(p, b.nextSibling);
                    r.setStart(p, 0);
                    r.collapse(true);
                    s.removeAllRanges();
                    s.addRange(r);
                    wysiwygSyncContent(ed);
                    return;
                }
                if (b.tagName === 'PRE') {
                    e.preventDefault();
                    r.deleteContents();
                    r.insertNode(document.createTextNode('\n'));
                    r.collapse(false);
                    s.removeAllRanges();
                    s.addRange(r);
                    wysiwygSyncContent(ed);
                    return;
                }
                if (b.tagName === 'BLOCKQUOTE') {
                    e.preventDefault();
                    const d = document.createElement('div');
                    d.innerHTML = '<br>';
                    r.insertNode(d);
                    r.setStartAfter(d);
                    r.collapse(true);
                    wysiwygSyncContent(ed);
                    return;
                }
            }
            b = b.parentNode;
        }
    });
</script>
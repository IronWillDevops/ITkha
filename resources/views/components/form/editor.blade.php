@props([
    'name' => 'content',
    'value' => old($name, $value ?? ''),
    'locale' => app()->getLocale(),
    'saveImagesAs' => 'server',
    'id' => null,
    'label' => null,
    'required' => false,
    'error' => null,
    'modelType' => 'App\\Models\\Post',
    'modelId' => null,
])
@php
    $editorId = $id ?? 'editor-' . Str::random(8);
    $cleanValue = trim($value);
    if (empty($cleanValue)) {
        $cleanValue = '<div><br></div>';
    }
@endphp
<div class="wysiwyg w-full" data-wysiwyg-id="{{ $editorId }}" data-locale="{{ $locale }}"
    data-save-images-as="{{ $saveImagesAs }}" data-upload-url="{{ route('admin.wysiwyg.upload') }}"
    data-delete-url="{{ route('admin.wysiwyg.delete') }}" data-model-type="{{ $modelType }}"
    data-model-id="{{ $modelId }}">
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
        <button type="button" onclick="wysiwygOpenFileUpload(event, 'image')" data-i18n-title="imageFile"
            title="Insert Image">
            <i class="fa-solid fa-image"></i>
        </button>
        <button type="button" onclick="wysiwygOpenFileUpload(event, 'file')" data-i18n-title="file"
            title="Insert File">
            <i class="fa-solid fa-file"></i>
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

    <div contenteditable="true" class="wysiwyg-content" id="{{ $editorId }}" oninput="wysiwygSyncContent(this)"
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
        <span class="wysiwyg-status-item wysiwyg-credits">
            <i class="fa-solid fa-code"></i>
            <span>Made by ITkha</span>
        </span>
    </div>

    <input type="hidden" name="{{ $name }}" value="" data-wysiwyg-hidden
        @if ($required) required @endif>

    <input type="file" class="wysiwyg-file-input" style="display: none;"
        accept="image/*,application/pdf,.doc,.docx,.txt,.zip,.rar" onchange="wysiwygHandleFileSelect(event)">
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
            <div class="wysiwyg-form-group" id="modalUrlGroup">
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
            <div class="wysiwyg-form-group" id="modalDeleteMediaGroup" style="display:none;">
                <button type="button" class="wysiwyg-btn wysiwyg-danger-btn" onclick="wysiwygDeleteMedia()"
                    data-i18n="deleteMedia">
                    Delete media
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


<script>
    const WYSIWYG_I18N = {
        en: {
            undo: 'Undo (Ctrl+Z)',
            redo: 'Redo (Ctrl+Y)',
            bold: 'Bold (Ctrl+B)',
            italic: 'Italic (Ctrl+I)',
            underline: 'Underline (Ctrl+U)',
            strikethrough: 'Strikethrough',
            highlight: 'Highlight',
            text: 'Text',
            bulletList: 'Bullet list',
            numberedList: 'Numbered list',
            outdent: 'Outdent',
            indent: 'Indent',
            alignLeft: 'Align left',
            alignCenter: 'Align center',
            alignRight: 'Align right',
            alignJustify: 'Justify',
            superscript: 'Superscript',
            subscript: 'Subscript',
            code: 'Code block',
            note: 'Note block',
            horizontalRule: 'Horizontal rule',
            link: 'Insert link',
            imageFile: 'Insert image',
            file: 'Insert file',
            clearFormat: 'Clear formatting',
            clearAll: 'Clear all',
            insert: 'Insert',
            url: 'URL',
            openInNewTab: 'Open in new tab',
            alignment: 'Alignment',
            left: 'Left',
            center: 'Center',
            right: 'Right',
            deleteLink: 'Delete link',
            deleteMedia: 'Delete media',
            cancel: 'Cancel',
            apply: 'Apply',
            insertImage: 'Insert image',
            insertFile: 'Insert file',
            editLink: 'Edit link',
            editImage: 'Edit image',
            editFile: 'Edit file',
            words: '{count} word{s}',
            characters: '{count} character{s}',
            paragraph: 'Paragraph',
            block: 'Block',
            heading1: 'Heading 1',
            heading2: 'Heading 2',
            heading3: 'Heading 3',
            heading4: 'Heading 4',
            heading5: 'Heading 5',
            heading6: 'Heading 6',
            codeBlock: 'Code',
            noteBlock: 'Note',
            list: 'List',
            numberedListBlock: 'Numbered List',
            listItem: 'List Item',
            clearAllConfirm: 'Are you sure you want to clear all content?',
            uploading: 'Uploading...',
            uploadSuccess: 'Upload successful!',
            uploadError: 'Upload failed. Please try again.'
        },
        ru: {
            undo: 'Отменить (Ctrl+Z)',
            redo: 'Повторить (Ctrl+Y)',
            bold: 'Жирный (Ctrl+B)',
            italic: 'Курсив (Ctrl+I)',
            underline: 'Подчеркнутый (Ctrl+U)',
            strikethrough: 'Зачеркнутый',
            highlight: 'Выделить',
            text: 'Текст',
            bulletList: 'Маркированный список',
            numberedList: 'Нумерованный список',
            outdent: 'Уменьшить отступ',
            indent: 'Увеличить отступ',
            alignLeft: 'По левому краю',
            alignCenter: 'По центру',
            alignRight: 'По правому краю',
            alignJustify: 'По ширине',
            superscript: 'Надстрочный',
            subscript: 'Подстрочный',
            code: 'Блок кода',
            note: 'Блок заметки',
            horizontalRule: 'Горизонтальная линия',
            link: 'Вставить ссылку',
            imageFile: 'Вставить изображение',
            file: 'Вставить файл',
            clearFormat: 'Очистить форматирование',
            clearAll: 'Очистить все',
            insert: 'Вставить',
            url: 'URL',
            openInNewTab: 'Открыть в новой вкладке',
            alignment: 'Выравнивание',
            left: 'Слева',
            center: 'По центру',
            right: 'Справа',
            deleteLink: 'Удалить ссылку',
            deleteMedia: 'Удалить медиа',
            cancel: 'Отмена',
            apply: 'Применить',
            insertImage: 'Вставить изображение',
            insertFile: 'Вставить файл',
            editLink: 'Редактировать ссылку',
            editImage: 'Редактировать изображение',
            editFile: 'Редактировать файл',
            words: '{count} слов{s}',
            characters: '{count} символ{s}',
            paragraph: 'Параграф',
            block: 'Блок',
            heading1: 'Заголовок 1',
            heading2: 'Заголовок 2',
            heading3: 'Заголовок 3',
            heading4: 'Заголовок 4',
            heading5: 'Заголовок 5',
            heading6: 'Заголовок 6',
            codeBlock: 'Код',
            noteBlock: 'Заметка',
            list: 'Список',
            numberedListBlock: 'Нумерованный список',
            listItem: 'Элемент списка',
            clearAllConfirm: 'Вы уверены, что хотите очистить весь контент?',
            uploading: 'Загрузка...',
            uploadSuccess: 'Загрузка успешна!',
            uploadError: 'Ошибка загрузки. Попробуйте снова.'
        },
        uk: {
            undo: 'Скасувати (Ctrl+Z)',
            redo: 'Повторити (Ctrl+Y)',
            bold: 'Жирний (Ctrl+B)',
            italic: 'Курсив (Ctrl+I)',
            underline: 'Підкреслений (Ctrl+U)',
            strikethrough: 'Закреслений',
            highlight: 'Виділити',
            text: 'Текст',
            bulletList: 'Маркований список',
            numberedList: 'Нумерований список',
            outdent: 'Зменшити відступ',
            indent: 'Збільшити відступ',
            alignLeft: 'По лівому краю',
            alignCenter: 'По центру',
            alignRight: 'По правому краю',
            alignJustify: 'По ширині',
            superscript: 'Надрядковий',
            subscript: 'Підрядковий',
            code: 'Блок коду',
            note: 'Блок нотатки',
            horizontalRule: 'Горизонтальна лінія',
            link: 'Вставити посилання',
            imageFile: 'Вставити зображення',
            file: 'Вставити файл',
            clearFormat: 'Очистити форматування',
            clearAll: 'Очистити все',
            insert: 'Вставити',
            url: 'URL',
            openInNewTab: 'Відкрити в новій вкладці',
            alignment: 'Вирівнювання',
            left: 'Зліва',
            center: 'По центру',
            right: 'Справа',
            deleteLink: 'Видалити посилання',
            deleteMedia: 'Видалити медіа',
            cancel: 'Скасувати',
            apply: 'Застосувати',
            insertImage: 'Вставити зображення',
            insertFile: 'Вставити файл',
            editLink: 'Редагувати посилання',
            editImage: 'Редагувати зображення',
            editFile: 'Редагувати файл',
            words: '{count} слів{s}',
            characters: '{count} символ{s}',
            paragraph: 'Параграф',
            block: 'Блок',
            heading1: 'Заголовок 1',
            heading2: 'Заголовок 2',
            heading3: 'Заголовок 3',
            heading4: 'Заголовок 4',
            heading5: 'Заголовок 5',
            heading6: 'Заголовок 6',
            codeBlock: 'Код',
            noteBlock: 'Нотатка',
            list: 'Список',
            numberedListBlock: 'Нумерований список',
            listItem: 'Елемент списку',
            clearAllConfirm: 'Ви впевнені, що хочете очистити весь контент?',
            uploading: 'Завантаження...',
            uploadSuccess: 'Завантаження успішне!',
            uploadError: 'Помилка завантаження. Спробуйте ще раз.'
        }
    };

    const WC = {
        blocks: ['P', 'DIV', 'H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'BLOCKQUOTE', 'PRE', 'LI'],
        headings: ['H1', 'H2', 'H3', 'H4', 'H5', 'H6'],
        names: {
            P: 'paragraph',
            DIV: 'block',
            H1: 'heading1',
            H2: 'heading2',
            H3: 'heading3',
            H4: 'heading4',
            H5: 'heading5',
            H6: 'heading6',
            PRE: 'codeBlock',
            BLOCKQUOTE: 'noteBlock',
            UL: 'list',
            OL: 'numberedListBlock',
            LI: 'listItem'
        },
        align: {
            left: 'left',
            start: 'left',
            center: 'center',
            right: 'right',
            end: 'right',
            justify: 'justify'
        },
        editor: null,
        file: null,
        mode: null,
        link: null,
        range: null,
        mediaWrapper: null,
        locale: 'en',
        saveImagesAs: 'url',
        uploadUrl: null,
        deleteUrl: null,
        modelType: null,
        modelId: null,
        csrfToken: null,
        uploadedMediaUrl: null,
        uploadedMediaId: null,
        uploadType: null
    };

    function t(key, params = {}) {
        const locale = WC.locale || 'en';
        const translations = WYSIWYG_I18N[locale] || WYSIWYG_I18N.en;
        let text = translations[key] || WYSIWYG_I18N.en[key] || key;
        Object.keys(params).forEach(k => {
            text = text.replace(`{${k}}`, params[k]);
        });
        return text;
    }

    function applyI18n(container) {
        container.querySelectorAll('[data-i18n]').forEach(el => {
            el.textContent = t(el.getAttribute('data-i18n'));
        });
        container.querySelectorAll('[data-i18n-title]').forEach(el => {
            el.title = t(el.getAttribute('data-i18n-title'));
        });
    }

    function getEd(e) {
        let tg = e.target;
        while (tg && !tg.hasAttribute('data-wysiwyg-id')) tg = tg.parentElement;
        return tg?.querySelector('.wysiwyg-content');
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
        const s = window.getSelection(),
            r = document.createRange();
        r.setStart(tn, 1);
        r.collapse(true);
        s.removeAllRanges();
        s.addRange(r);
    }

    function setCaret(el) {
        const r = document.createRange(),
            s = window.getSelection();
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

    /**
     * Загрузка файла (изображения или документа) на сервер
     */
    async function uploadFileToServer(file) {
        const formData = new FormData();
        formData.append('file', file);
        formData.append('model_type', WC.modelType || 'App\\Models\\User');
        formData.append('model_id', WC.modelId || '');

        console.log('Uploading file:', {
            fileName: file.name,
            fileSize: file.size,
            fileType: file.type,
            uploadUrl: WC.uploadUrl,
            modelType: WC.modelType,
            modelId: WC.modelId,
            hasCsrfToken: !!WC.csrfToken
        });

        try {
            const response = await fetch(WC.uploadUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': WC.csrfToken,
                    'Accept': 'application/json',
                },
                body: formData
            });

            let data;
            try {
                data = await response.json();
            } catch (e) {
                console.error('Failed to parse response:', e);
                throw new Error('Server returned invalid response');
            }

            console.log('Upload response:', data);

            if (!response.ok || !data.success) {
                const errorMsg = data.message || 'Upload failed';
                console.error('Upload failed:', errorMsg, data);
                throw new Error(errorMsg);
            }

            return {
                url: data.url,
                mediaId: data.media_id,
                isImage: data.is_image,
                mimeType: data.mime_type,
                originalName: data.original_name,
                size: data.size,
                humanSize: data.human_size
            };
        } catch (error) {
            console.error('Upload error:', error);
            throw error;
        }
    }

    // Добавьте эту функцию после других функций
    function ensureEditorStructure(ed) {
        // Проверяем, есть ли хоть какой-то контент
        const hasContent = ed.innerHTML.trim() && ed.textContent.trim();
        
        // Если есть контент, но нет блочных элементов (только текстовые ноды)
        if (hasContent) {
            const hasBlockElement = ed.querySelector('div, p, h1, h2, h3, h4, h5, h6, ul, ol, blockquote, pre');
            if (!hasBlockElement) {
                // Оборачиваем существующий текст в div
                const tempDiv = document.createElement('div');
                while (ed.firstChild) {
                    tempDiv.appendChild(ed.firstChild);
                }
                ed.appendChild(tempDiv);
                return true;
            }
            return false;
        }
        
        // Если редактор полностью пустой, создаем начальную структуру
        if (!ed.innerHTML.trim() || ed.innerHTML === '' || ed.textContent.trim() === '') {
            ed.innerHTML = '<div><br></div>';
            return true;
        }
        
        return false;
    }

    // Модифицируйте функцию wysiwygSyncContent
    function wysiwygSyncContent(ed) {
        const c = ed.closest('.wysiwyg'),
            h = c?.querySelector('input[type="hidden"][data-wysiwyg-hidden]');

        if (h) h.value = ed.innerHTML;

        // Получаем текст и очищаем
        const txt = ed.innerText || '';
        const cleanedText = txt.replace(/^\s+|\s+$/g, '');

        // Проверяем, пустой ли контент
        const isEmpty = cleanedText.length === 0 || ed.innerHTML === '<div><br></div>' || ed.innerHTML === '<br>';

        const w = isEmpty ? 0 : cleanedText.trim().split(/\s+/).filter(x => x.length).length;
        const ch = isEmpty ? 0 : cleanedText.length;

        const wc = c.querySelector('.wysiwyg-word-count'),
            cc = c.querySelector('.wysiwyg-char-count');
        if (wc) wc.textContent = t('words', {
            count: w,
            s: w !== 1 ? 's' : ''
        });
        if (cc) cc.textContent = t('characters', {
            count: ch,
            s: ch !== 1 ? 's' : ''
        });

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
                if (n.nodeName === 'SUP') c.querySelector('[onclick*="wysiwygToggleScript"][onclick*="superscript"]')
                    ?.classList.add('active');
                if (n.nodeName === 'SUB') c.querySelector('[onclick*="wysiwygToggleScript"][onclick*="subscript"]')
                    ?.classList.add('active');
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
        const r = s.getRangeAt(0),
            h = isInside(r, n => {
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
        const r = s.getRangeAt(0),
            tag = type === 'superscript' ? 'SUP' : 'SUB',
            el = findP(r.startContainer, tag, ed);
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
            if (n.nodeType === 1 && ['P', 'DIV', 'H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'BLOCKQUOTE', 'LI'].includes(n
                    .nodeName) && ed.contains(n)) {
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
        const r = s.getRangeAt(0),
            bs = new Set(),
            w = document.createTreeWalker(ed, NodeFilter.SHOW_ELEMENT, {
                acceptNode(n) {
                    if (WC.blocks.includes(n.nodeName)) {
                        const nr = document.createRange();
                        nr.selectNodeContents(n);
                        if (r.compareBoundaryPoints(Range.END_TO_START, nr) < 0 && r.compareBoundaryPoints(Range
                                .START_TO_END, nr) > 0) return NodeFilter.FILTER_ACCEPT;
                    }
                    return NodeFilter.FILTER_SKIP;
                }
            });
        let n = w.nextNode();
        while (n) {
            bs.add(n);
            n = w.nextNode();
        }
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
            ed.innerHTML = '<div><br></div>';
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
        document.getElementById('modalUrlGroup').style.display = cfg.url ? 'block' : 'none';
        document.getElementById('modalTextGroup').style.display = cfg.txt ? 'block' : 'none';
        document.getElementById('modalTargetGroup').style.display = cfg.tgt ? 'block' : 'none';
        document.getElementById('modalAlignGroup').style.display = cfg.aln ? 'block' : 'none';
        document.getElementById('modalDeleteGroup').style.display = cfg.del ? 'block' : 'none';
        document.getElementById('modalDeleteMediaGroup').style.display = cfg.delMedia ? 'block' : 'none';
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
        showM(lnk ? 'editLink' : 'link', {
            url: 1,
            txt: 1,
            tgt: 1,
            aln: 0,
            del: !!lnk,
            delMedia: 0,
            prv: 0
        });
    }

    function wysiwygOpenFileUpload(e, type) {
        const ed = getEd(e);
        if (!ed) return;
        WC.editor = ed;
        WC.uploadType = type;
        const s = window.getSelection();
        if (s.rangeCount) WC.range = s.getRangeAt(0).cloneRange();

        const input = ed.closest('.wysiwyg').querySelector('.wysiwyg-file-input');
        if (type === 'image') {
            input.accept = 'image/*';
        } else {
            input.accept = 'application/pdf,.doc,.docx,.txt,.zip,.rar,.xls,.xlsx,.ppt,.pptx';
        }
        input.click();
    }

    async function wysiwygHandleFileSelect(e) {
        const f = e.target.files[0];
        if (!f) return;
        WC.file = f;
        const isImg = f.type.startsWith('image/');
        WC.mode = isImg ? 'image' : 'file';
        const prv = document.getElementById('wysiwygModalPreview'),
            img = document.getElementById('wysiwygModalImagePreview'),
            inf = document.getElementById('wysiwygModalFileInfo'),
            nm = document.getElementById('wysiwygModalFileName');

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

        // ИСПРАВЛЕНИЕ: Скрываем поле URL для новых файлов/картинок
        showM(isImg ? 'insertImage' : 'insertFile', {
            url: 0,  // Скрываем URL для новых файлов
            txt: isImg,
            tgt: 0,
            aln: isImg,
            del: 0,
            delMedia: 0,
            prv: 1
        });

        if (WC.saveImagesAs === 'server') {
            const modalBody = document.querySelector('.wysiwyg-modal-body');
            const loadingMsg = document.createElement('div');
            loadingMsg.className = 'wysiwyg-loading-message';
            loadingMsg.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> ' + t('uploading');

            modalBody.insertBefore(loadingMsg, modalBody.firstChild);

            const applyBtn = document.querySelector('.wysiwyg-btn-primary');
            if (applyBtn) {
                applyBtn.disabled = true;
                applyBtn.style.opacity = '0.5';
                applyBtn.style.cursor = 'not-allowed';
            }

            try {
                const result = await uploadFileToServer(f);
                WC.uploadedMediaUrl = result.url;
                WC.uploadedMediaId = result.mediaId;

                if (isImg) {
                    img.src = result.url;
                }

                loadingMsg.innerHTML = '<i class="fa-solid fa-check-circle"></i> ' + t('uploadSuccess');
                loadingMsg.style.background = '#10b981';

                if (applyBtn) {
                    applyBtn.disabled = false;
                    applyBtn.style.opacity = '1';
                    applyBtn.style.cursor = 'pointer';
                }

                setTimeout(() => loadingMsg.remove(), 2000);
            } catch (error) {
                console.error('Upload failed:', error);
                loadingMsg.innerHTML = '<i class="fa-solid fa-times-circle"></i> ' + (error.message || t(
                    'uploadError'));
                loadingMsg.style.background = '#ef4444';

                if (applyBtn) {
                    applyBtn.disabled = false;
                    applyBtn.style.opacity = '1';
                    applyBtn.style.cursor = 'pointer';
                }

                setTimeout(() => {
                    loadingMsg.remove();
                }, 3000);
            }
        }
    }

    function wysiwygEditMedia(wrapper, isImage) {
        const ed = wrapper.closest('.wysiwyg-content');
        if (!ed) return;
        WC.editor = ed;
        WC.mode = isImage ? 'image-edit' : 'file-edit';
        WC.mediaWrapper = wrapper;

        if (isImage) {
            const img = wrapper.querySelector('img'),
                // ИСПРАВЛЕНИЕ: Используем правильный селектор
                cap = wrapper.querySelector('.wysiwyg-image-caption');
            const align = wrapper.classList.contains('align-left') ? 'left' :
                wrapper.classList.contains('align-right') ? 'right' : 'center';
            document.getElementById('wysiwygModalUrl').value = img.src;
            document.getElementById('wysiwygModalText').value = cap ? cap.textContent : '';
            const prv = document.getElementById('wysiwygModalPreview'),
                prvImg = document.getElementById('wysiwygModalImagePreview'),
                inf = document.getElementById('wysiwygModalFileInfo');
            prvImg.src = img.src;
            prvImg.style.display = 'block';
            inf.style.display = 'none';
            prv.style.display = 'block';
            document.querySelectorAll('.wysiwyg-align-btn').forEach(b => b.classList.remove('active'));
            document.querySelector(`.wysiwyg-align-btn[data-align="${align}"]`)?.classList.add('active');
            WC.uploadedMediaId = img.dataset.mediaId || null;
            // ИСПРАВЛЕНИЕ: Скрываем URL при редактировании картинки
            showM('editImage', {
                url: 0,  // Скрываем URL при редактировании
                txt: 1,
                tgt: 0,
                aln: 1,
                del: 0,
                delMedia: 1,
                prv: 1
            });
        }
    }

    function wysiwygCloseUniversalModal() {
        document.getElementById('wysiwygUniversalModal').style.display = 'none';
        const img = document.getElementById('wysiwygModalImagePreview'),
            inf = document.getElementById('wysiwygModalFileInfo');
        img.src = '';
        img.style.display = 'none';
        inf.style.display = 'none';
        WC.uploadedMediaUrl = null;
        WC.uploadedMediaId = null;
        WC.mode = WC.link = WC.file = WC.mediaWrapper = null;
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
                const r = s.getRangeAt(0),
                    a = document.createElement('a');
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
            const w = WC.mediaWrapper;
            if (!w) return;
            const cap = document.getElementById('wysiwygModalText').value.trim();
            const al = document.querySelector('.wysiwyg-align-btn.active')?.dataset.align || 'left';
            w.className = `wysiwyg-image-wrapper align-${al}`;
            let capEl = w.querySelector('.wysiwyg-image-caption');
            if (cap) {
                if (!capEl) {
                    capEl = document.createElement('figcaption');
                    capEl.className = 'wysiwyg-image-caption';
                    w.appendChild(capEl);
                }
                capEl.textContent = cap;
            } else if (capEl) capEl.remove();
        }

        if (WC.mode === 'image') {
            const cap = document.getElementById('wysiwygModalText').value.trim(),
                al = document.querySelector('.wysiwyg-align-btn.active')?.dataset.align || 'left',
                w = document.createElement('figure');

            w.className = `wysiwyg-image-wrapper align-${al}`;
            w.contentEditable = 'false';
            w.onclick = function() {
                if (this.closest('.wysiwyg-content')) {
                    wysiwygEditMedia(this, true);
                }
            };

            const img = document.createElement('img');

            if (WC.saveImagesAs === 'server' && WC.uploadedMediaUrl) {
                img.src = WC.uploadedMediaUrl;
                if (WC.uploadedMediaId) {
                    img.dataset.mediaId = WC.uploadedMediaId;
                }
            } else if (WC.saveImagesAs === 'base64') {
                img.src = await fileToBase64(WC.file);
            } else {
                img.src = URL.createObjectURL(WC.file);
            }

            img.alt = cap || 'Image';
            w.appendChild(img);

            if (cap) {
                const c = document.createElement('figcaption');
                c.className = 'wysiwyg-image-caption';
                c.textContent = cap;
                w.appendChild(c);
            }

            if (s.rangeCount) {
                const r = s.getRangeAt(0);
                r.deleteContents();
                r.insertNode(w);

                if (al === 'center') {
                    const p = document.createElement('p');
                    p.innerHTML = '<br>';
                    w.parentNode.insertBefore(p, w.nextSibling);
                    r.setStart(p, 0);
                    r.collapse(true);
                } else {
                    r.setStartAfter(w);
                    r.collapse(true);
                }

                s.removeAllRanges();
                s.addRange(r);
            } else {
                ed.appendChild(w);
            }
        }

        if (WC.mode === 'file') {
            const f = WC.file;
            if (!f) return;

            const a = document.createElement('a');

            if (WC.saveImagesAs === 'server' && WC.uploadedMediaUrl) {
                a.href = WC.uploadedMediaUrl;
                if (WC.uploadedMediaId) {
                    a.dataset.mediaId = WC.uploadedMediaId;
                }
            } else {
                a.href = URL.createObjectURL(f);
            }

            a.download = f.name;
            a.className = 'wysiwyg-file-attachment';
            a.contentEditable = 'false';
            a.innerHTML =
                `<i class="fa-solid fa-file wysiwyg-file-icon"></i><div class="wysiwyg-file-info"><span class="wysiwyg-file-name">${f.name}</span><span class="wysiwyg-file-size">${(f.size/1024).toFixed(1)} KB</span></div><i class="fa-solid fa-download wysiwyg-file-download"></i>`;

            if (s.rangeCount) {
                const r = s.getRangeAt(0);
                r.deleteContents();
                const div = document.createElement('div');
                div.appendChild(a);
                r.insertNode(div);
                const ndiv = document.createElement('div');
                ndiv.innerHTML = '<br>';
                div.parentNode.insertBefore(ndiv, div.nextSibling);
                r.setStart(ndiv, 0);
                r.collapse(true);
                s.removeAllRanges();
                s.addRange(r);
            } else {
                const div = document.createElement('div');
                div.appendChild(a);
                ed.appendChild(div);
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

    async function wysiwygDeleteMedia() {
        const w = WC.mediaWrapper;
        if (!w) return;

        const mediaElement = w.querySelector('img') || w.querySelector('a');
        const mediaId = mediaElement?.dataset.mediaId;

        if (mediaId && WC.csrfToken && WC.deleteUrl) {
            try {
                await fetch(WC.deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': WC.csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        media_id: mediaId
                    })
                });
            } catch (error) {
                console.error('Error deleting media from server:', error);
            }
        }

        w.remove();
        wysiwygSyncContent(WC.editor);
        wysiwygCloseUniversalModal();
    }

    document.addEventListener('DOMContentLoaded', function() {
        WC.csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

        if (!WC.csrfToken) {
            console.error(
                'WYSIWYG Editor: CSRF token not found! Add <meta name="csrf-token" content="{{ csrf_token() }}"> to your layout.'
            );
        }

        document.querySelectorAll('.wysiwyg').forEach(container => {
            const ed = container.querySelector('.wysiwyg-content');
            const locale = container.getAttribute('data-locale') || 'en';
            const saveAs = container.getAttribute('data-save-images-as') || 'server';

            WC.locale = locale;
            WC.saveImagesAs = saveAs;
            WC.uploadUrl = container.getAttribute('data-upload-url') || '/admin/wysiwyg/upload';
            WC.deleteUrl = container.getAttribute('data-delete-url') || '/admin/wysiwyg/delete';
            WC.modelType = container.getAttribute('data-model-type') || 'App\\Models\\User';
            WC.modelId = container.getAttribute('data-model-id') || null;

            console.log('WYSIWYG initialized:', {
                uploadUrl: WC.uploadUrl,
                deleteUrl: WC.deleteUrl,
                modelType: WC.modelType,
                modelId: WC.modelId,
                saveAs: WC.saveImagesAs,
                hasCsrfToken: !!WC.csrfToken
            });

            applyI18n(container);
            applyI18n(document.getElementById('wysiwygUniversalModal'));

            const h = container.querySelector('input[type="hidden"][data-wysiwyg-hidden]');
            if (h) h.value = ed.innerHTML;

            ed.querySelectorAll('.wysiwyg-image-wrapper').forEach(w => {
                w.onclick = function() {
                    wysiwygEditMedia(this, true);
                };
            });

            setTimeout(() => {
                updToolbar(ed);
                wysiwygSyncContent(ed);
            }, 100);
        });

        document.addEventListener('click', e => {
            if (e.target.closest('.wysiwyg-align-btn')) {
                const b = e.target.closest('.wysiwyg-align-btn'),
                    c = b.closest('.wysiwyg-align-buttons');
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
                if (n.classList?.contains('wysiwyg-content')) {
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
        let n = r.startContainer,
            ed = n;
        while (ed && !ed.classList?.contains('wysiwyg-content')) ed = ed.parentNode;
        if (!ed?.contains(n)) return;
        let b = n;
        while (b && b !== ed) {
            if (b.nodeType === 1) {
                if (/^H[1-6]$/.test(b.tagName)) {
                    e.preventDefault();
                    const div = document.createElement('div');
                    div.innerHTML = '<br>';
                    b.parentNode.insertBefore(div, b.nextSibling);
                    r.setStart(div, 0);
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

    // Добавьте в конец файла, в секцию document.addEventListener
    document.addEventListener('keyup', e => {
        if (e.key === 'Backspace' || e.key === 'Delete') {
            const s = window.getSelection();
            if (!s.rangeCount) return;

            let n = s.getRangeAt(0).startContainer;
            let ed = n;
            while (ed && !ed.classList?.contains('wysiwyg-content')) ed = ed.parentNode;

            if (ed) {
                ensureEditorStructure(ed);
                wysiwygSyncContent(ed);
            }
        }
    });
</script>
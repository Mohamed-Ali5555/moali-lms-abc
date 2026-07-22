<style>
    #preview img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
</style>
<div class="mb-3">
  <label for="options" class="form-label fw-bold">الاختيارات</label>
  <input id="options" name="options" class="form-control tagify" type="text"
         placeholder="أضف اختيارات (نص أو صورة)">
  <input type="hidden" name="options_data" id="options_data">
</div>

<div class="card p-3 shadow-sm border-0 mb-3">
  <label class="form-label fw-bold">إضافة صورة كخيار</label>
  <div class="input-group">
    <input type="file" id="image-option" accept="image/*" class="form-control">
    <button type="button" id="btn-add-image" class="btn btn-primary">
      <i class="bi bi-image me-1"></i> إضافة صورة
    </button>
  </div>
  <div id="preview" class="mt-3 d-flex flex-wrap gap-2"></div>
</div>

<div class="mb-3">
  <label for="answer-select2" class="form-label fw-bold">الإجابات الصحيحة</label>
  <select id="answer-select2" name="answer[]" multiple="multiple"
          style="width:100%" class="form-select"></select>
</div>
<script>
    window.optionStorageUrl = "{{ asset('storage/options') }}";

    var inputElm    = document.querySelector('#options');
    var imageInput  = document.querySelector('#image-option');
    var btnAddImage = document.querySelector('#btn-add-image');
    var preview     = document.querySelector('#preview');
    var hiddenInput = document.querySelector('#options_data'); // الانبوت الهيدن
    console.log(inputElm)
    if (inputElm && inputElm.tagify) {
        
        inputElm.tagify.destroy();
    }

    var tagify = new Tagify(inputElm, {
        maxTags: 10,
        dropdown: {
            enabled: 0,
            closeOnSelect: false
        }
    });
    var tempImages = window.tempImages || {}; 

    $('#answer-select2').select2({
        templateResult: formatState,
        templateSelection: formatState,
        escapeMarkup: m => m
    });

    function formatState(state){
        if(!state.id) return state.text;
        var $el = $(state.element);
        var img = $el.data('img');
        if(img){
            return `<span style="display:flex;align-items:center;">
                        <img src="${img}" style="height:40px;width:60px;object-fit:cover;margin-right:8px;border-radius:4px;" />
                        <span>${state.text || ''}</span>
                    </span>`;
        }
        return state.text;
    }

    function genTempName(file){
        var ext = (file.name.split('.').pop() || 'jpg').toLowerCase();
        var rnd = Math.random().toString(36).slice(2,8);
        return `tmp_${Date.now()}_${rnd}.${ext}`;
    }

    btnAddImage.addEventListener('click', ()=>{
        var f = imageInput.files[0];
        if(!f) return alert('اختر صورة أولاً');
        var tempName = genTempName(f);
        var previewUrl = URL.createObjectURL(f);

        tempImages[tempName] = { file: f, previewUrl };

        tagify.addTags([{ value: tempName }]);

        var img = document.createElement('img');
        img.src = previewUrl;
        img.dataset.temp = tempName;
        img.style.width = '80px';
        img.style.height = '80px';
        img.style.objectFit = 'cover';
        img.classList.add('rounded','border','m-1');
        preview.appendChild(img);

        imageInput.value = '';
        updateSelectOptions();
        updateHiddenInput();
    });

    inputElm.addEventListener('change', ()=>{
        updateSelectOptions();
        updateHiddenInput();
    });
    $('#answer-select2').on('change', updateHiddenInput);

    function updateSelectOptions(){
        let arr = [];
        try { arr = JSON.parse(inputElm.value || '[]'); } catch(e) { arr = []; }

        var $sel = $('#answer-select2');
        $sel.empty();

        arr.forEach(item => {
            var v = (typeof item === 'string') ? item : item.value || '';
            var isTemp = !!tempImages[v];
            let dataImg = null;

            if(isTemp) dataImg = tempImages[v].previewUrl;
            else if (/\.(jpe?g|png|gif|webp|svg)$/i.test(v)) {
                dataImg = window.optionStorageUrl + '/' + v.split('/').pop();
            }

            var text = isTemp ? 'صورة' : v;

            var $opt = $('<option>').val(v).text(text);
            if(dataImg) $opt.attr('data-img', dataImg);
            $sel.append($opt);
        });

        $sel.trigger('change.select2');
    }

    async function updateHiddenInput(){
        let optionsArr = [];
        try { optionsArr = JSON.parse(inputElm.value || '[]'); } catch(e) { optionsArr = []; }

        const answers = $('#answer-select2').val() || [];

        const promises = Object.entries(tempImages).map(([name, obj]) => {
            return new Promise(resolve => {
                const reader = new FileReader();
                reader.onload = e => resolve({ name, base64: e.target.result });
                reader.readAsDataURL(obj.file);
            });
        });

        const base64Images = await Promise.all(promises);

        const payload = {
            options: optionsArr,
            answers: answers,
            images: base64Images
        };

        hiddenInput.value = JSON.stringify(payload);
    }

    function removeImage(tempName){
        delete tempImages[tempName];
        $(`#preview img[data-temp="${tempName}"]`).remove();
        updateSelectOptions();
        updateHiddenInput();
    }
</script>

// DOMロード時にPHP定義の一部を同期
let __SITE__: string;
let __MANAGE__: string;
let __UPLOADS__: string;
let __PAGE_SLUG__: string;

/**
 * onload
 */
window.addEventListener('DOMContentLoaded', function(event)
{
	// PHP定義値の一部を、metaタグから取得する
	__SITE__ = <string>(<HTMLBaseElement>document.querySelector('meta[name="ashigaru:site"]')).getAttribute('content');
	__MANAGE__ = <string>(<HTMLBaseElement>document.querySelector('meta[name="ashigaru:manage"]')).getAttribute('content');
	__UPLOADS__ = <string>(<HTMLBaseElement>document.querySelector('meta[name="ashigaru:uploads"]')).getAttribute('content');
	__PAGE_SLUG__ = <string>(<HTMLBaseElement>document.querySelector('meta[name="ashigaru:page_slug"]')).getAttribute('content');

	// side menu changer
	window.addEventListener('resize', sidemenu_changer)
	sidemenu_changer();

	// お知らせ管理のイベント登録
	if('news'===__PAGE_SLUG__) {

		// お知らせ管理のカテゴリ絞り込みプルダウンの挙動
		const filter_cat = <HTMLInputElement>document.getElementById('filter-cat');
		if(filter_cat) {
			filter_cat.onchange = e=>{
				const cat_id = (<HTMLInputElement>e.target).value
				if(cat_id) {
					location.href = __MANAGE__+'/news/cat/'+cat_id+'/'
				} else {
					location.href = __MANAGE__+'/news/'
				}
			}
		}

		// アップロードPDF選択時にサムネ更新（BASE64セット）
		const pdf_upload_button = document.querySelectorAll('input.upload-pdf')
		if(pdf_upload_button) {
			pdf_upload_button.forEach(upload=>{
				(<HTMLInputElement>upload).onchange = e=>{
					const upload = <HTMLInputElement>e.target
					const files = upload.files
					const pdf_filename = <HTMLInputElement>document.getElementById('pdf-filename');
					const pdf_filename_label = <HTMLSpanElement>document.getElementById('pdf-filename-label');
					const hidden_base64 = <HTMLInputElement>document.querySelector('[name='+'pdf_base64]');
					const cancel = <HTMLDivElement>document.getElementById('pdf-cancel');
					const reader = new FileReader();
					reader.onload = e=>{
						if(e.target) {
							hidden_base64.value = <string>e.target.result
							pdf_filename.value = pdf_filename_label.innerText = <string>files![0].name
							cancel.style.visibility = 'visible'
							// cancel.style.display = 'inline'
						}
					}
					if(files && files[0]) reader.readAsDataURL(files[0]);
				}
			})
		}

		// アップロードPDF選択後のキャンセルボタン処理
		const cancel_button = document.querySelectorAll('button.cancel-button')
		if(cancel_button) {
			cancel_button.forEach(cancel=>{
				(<HTMLButtonElement>cancel).onclick = e=>{
					const name = cancel.getAttribute('data-for');
					(<HTMLDivElement>document.getElementById(name+'-cancel')).style.visibility = 'hidden'
					// (<HTMLDivElement>document.getElementById(name+'-cancel')).style.display = 'none'
					const filename = <HTMLInputElement>document.getElementById(name+'-filename');
					const filename_label = <HTMLSpanElement>document.getElementById(name+'-filename-label');
					(<HTMLInputElement>document.querySelector('[name='+name+']')).value = '';
					const base64 = <HTMLInputElement>document.querySelector('[name='+name+'_base64]');
					const hidden_upped = <HTMLInputElement>document.querySelector('[name='+name+'_upped]');
					if(hidden_upped.value) {
						filename.value = filename_label.innerText = hidden_upped.value
						base64.value = ''
					} else {
						filename.value = filename_label.innerText = ''
						base64.value = ''
					}
				}
			})
		}

		// PDFプレビューリンククリック
		const pdf_preview_button = document.getElementById('pdf-preview-form-submit')
		if(pdf_preview_button) {
			pdf_preview_button.onclick = e => {
				const hidden_base64 = <HTMLInputElement>document.getElementById('pdf-base64');
				const hidden_base64_for_preview = <HTMLInputElement>document.getElementById('pdf-base64-for-preview');
				hidden_base64_for_preview.value = hidden_base64.value
				const pdf_filename = <HTMLInputElement>document.getElementById('pdf-filename');
				const pdf_filename_for_preview = <HTMLInputElement>document.getElementById('pdf-filename-for-preview');
				pdf_filename_for_preview.value = pdf_filename.value
				const form = <HTMLFormElement>document.getElementById('pdf-preview-form')
				form.submit()
			}
		}
	}

	/**
	 * 現在の日付をセットするボタン
	 */
	var set_current_time = document.getElementById('set-current-time')
	if(set_current_time) {
		set_current_time.onclick = function(e) {
			const now = new Date();
			const year      = now.getFullYear()
			const month     = (now.getMonth()+1) < 10 ? '0'+(now.getMonth()+1) : (now.getMonth()+1)
			const date      = (now.getDate() < 10 ? '0'+now.getDate() : now.getDate())
			const hour      = (now.getHours() < 10 ? '0'+now.getHours() : now.getHours())
			const minute    = (now.getMinutes() < 10 ? '0'+now.getMinutes() : now.getMinutes());
			var published_date = <HTMLInputElement>document.querySelector('[name=published_date]')
			if(published_date) published_date.value = year+'-'+month+'-'+date;
			var published_time = <HTMLInputElement>document.querySelector('[name=published_time]')
			if(published_time) published_time.value = hour+':'+minute;
		}
	}

	/**
	 * データ操作ボタン：GET
	 * ex.
	 *    <button type="button"
	 *        data-get-action="/delete/y/%s/m/%s/"
	 *        data-bind-ids="year,month" // URLの%sに置き換えたい順で要素のidを指定。checkboxはカンマ連結
	 *        data-on-send='alert('xxx'); retrun false' // 送信前に実行する関数
	 *        data-confirm='ページを移動しますか？' // 任意
	 *    >
	*/
	document.querySelectorAll('[data-get-action]').forEach(button=>{
		(<HTMLButtonElement>button).onclick = e=>{
			let action = button.getAttribute('data-get-action')
			const confirm = button.getAttribute('data-confirm')
			const bind_ids = button.getAttribute('data-bind-ids')
			const on_send = button.getAttribute('data-on-send')
			if(on_send) {
				var f = Function(on_send)
				if(false===f()) return false
			}
			if(action) {
				if(confirm && !window.confirm(confirm)) return
				if(bind_ids) {
					const ids = bind_ids.split(/,\s+/)
					for(let id of ids) {
						let replace_value = ''
						const elm = <HTMLInputElement>document.querySelector('[id='+id+']')
						if(elm) {
							if('radio'===elm.type || 'checkbox'===elm.type) {
								const checked_elms = document.querySelectorAll('[id='+id+']:checked')
								let replace_values = []
								for(var checked_elm of Array.from(checked_elms)) {
									replace_values.push((<HTMLInputElement>checked_elm).value)
								}
								replace_value = replace_values.join(',')
							} else {
								replace_value = elm.value;
							}
							action = action.replace(/%s/, replace_value)
						}
					}
				}
				location.href = action
			}
		}
	})

	/**
	 * データ操作ボタン：POST
	 * ex.
	 *    <button type="button"
	 *        data-post-action="/delete/"
	 *        data-params='{"entry_id":<?= $entry->id ?>}'
	 *        data-confirm='ID<?= $entry->id ?>の記事を削除していい？' // 任意
	 *        data-target-form='post-action-form'
	 *    >
	*/
	document.querySelectorAll('[data-post-action]').forEach(button=>{
		(<HTMLButtonElement>button).onclick = e=>{

			// 各種データ変数セット
			const action = button.getAttribute('data-post-action')
			const confirm = button.getAttribute('data-confirm')
			const params = button.getAttribute('data-params')
			let form = <HTMLFormElement>document.getElementById('post-action-form')

			// 送信に使うフォームを #post-action-form 以外のものに指定した場合
			if(!form) {
				const target_form = button.getAttribute('data-target-form')
				if(target_form) {
					const spec_form = <HTMLFormElement>document.getElementById(target_form)
					if(spec_form) form = spec_form
				}
			}

			// フォームにPOSTするクエリデータをhidden要素にしてセット
			if(params) {
				const json = JSON.parse(params)
				const keys = Object.keys(json)
				for(let key of keys) {
					const input = document.createElement('input');
					input.type = "hidden"
					input.name = key
					input.value = json[key]
					form.appendChild(input);
				}
			}

			// フォームをPOST送信する
			if(action) {
				if(confirm && !window.confirm(confirm)) return
				form.action = action
				form.submit()
			}
		}
	})
})

/**
 * サイドメニュー部分を、PCの場合は通常表示、SPの場合はUIKitのOffCanvasを利用するように切り替える
 */
function sidemenu_changer()
{
	var $sideMenu = document.querySelector('#side-menu');
	if(!$sideMenu) return;
	var $sideMenuDiv = document.querySelector('#side-menu>div.oc-wrap');
	if(960<document.body.clientWidth) {
		if(!$sideMenu.getAttribute('uk-offcanvas')) return;
		$sideMenu.removeAttribute('uk-offcanvas');
		$sideMenu.classList.remove('uk-offcanvas')
		$sideMenuDiv?.classList.remove('uk-offcanvas-bar')
	} else {
		if($sideMenu.getAttribute('uk-offcanvas')) return;
		$sideMenu.setAttribute('uk-offcanvas', 'mode:push; flip:true; overlay:true');
		$sideMenuDiv?.classList.add('uk-offcanvas-bar')
	}
}

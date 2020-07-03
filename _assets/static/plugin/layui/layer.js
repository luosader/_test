/*! layer-v3.0.1 Web弹层组件 MIT License  http://layer.layui.com/  Modify By Dr.dragon */
/****************************************************
	@ Example
	layer.form({
		title: '请填写信息',
		area: ['500px'],		// 宽高
		cols: ['30%', '70%'],	// 列宽
		shade: 0,      
		maxmin: true, // 开启最大化最小化按钮
		autoClose: true,	// 提交之后是否自动关闭
		form: {
			notice: '这是一段说明文字|t=rowhtml',
			notice2: '说明|v=这也是说明|t=html',
			key: 'sss|required',
			age: '年龄|required|int|r=10,200|v=100|p=24',
			amount: '总价|required|n=10 ~ 2000|float|r=10.00,2000.00,2|v=100.45|p=0.00',
			gid: {
				name: '游戏',
				type: 'select',
				options: gameConfigs,
				width: '100%',	// 宽度
				option_key: 'id',	// 选项键
				option_val: 'title',	// 选项值
				change: function (row, l) {		//row 此项、 l 弹出层
					var gid = row.val;
					l.formRowChange('aid', {options: gameAreas(gid)});
				}
			},
			gid: {
				name: '游戏',
				type: 'select',
				options: gameConfigs,
				width: '100%',	// 宽度
				option_key: 'id',	// 选项键
				option_val: 'title',	// 选项值
				change: function (row, l) {		//row 此项、 l 弹出层
					var gid = row.val;
					l.formRowChange('aid', {options: gameAreas(gid)});
				}
			},
			aid: {
				name: '分区',
				type: 'select',
				val_type: 'int',	// 整型
				options: {},
				width: '100%',	// 宽度
				option_key: 'id',	// 选项键
				option_val: 'title',	// 选项值
				change: function (row, l) {
					var aid = row.val;
					if(l.form.sex) {
						// 移除一项
						l.formRowRemove('sex');
					} else {
						// 添加一项 / 多项
						l.formRowsAdd({
							sex: {
								before: 'like', // 在哪一项之前，默认插入行尾部
								name: '性别',
								type: 'radio',
								options: {0: '男', 1: '女'},
								width: '200px'	// 单元项宽度
							}
						});	// 在谁后面添加
					}
				}
			},
			sex: {
				name: '性别',
				type: 'radio',
				options: {0: '男', 1: '女'},
				width: '200px'	// 单元项宽度
			},
			like: {
				name: '喜好',
				type: 'checkbox',
				options: {0: '读书', 1: '写字'}
			},
			note: {
				name: '说明',
				type: 'textarea',
				height: '100px'		// 输入框高度
			}
		}
	}, function (data) {
		console.log(data);
	});
	
	$('.layui-layer-input').tips('2343242');
	$('.layui-layer-input').tips('2343242', {tips:[3, '#036'], time: 10000});
 ***************************************************/
;
!function(e, t) {
    "use strict";
	
	// 常用函数扩展
	// 四舍五入
	Number.prototype.round = function (n) {
		var digit = Math.pow(10, n);
		return Math.round(this*digit)/digit;
	}
	// 进位取整
	Number.prototype.ceil = function (n) {
		var digit = Math.pow(10, n);
		return Math.ceil(this*digit)/digit;
	}
	// 退位取整
	Number.prototype.floor = function (n) {
		var digit = Math.pow(10, n);
		return Math.floor(this*digit)/digit;
	}
	
	String.prototype.trim = function() {
		return this.replace( /(^\s*)|(\s*$)/g, '');
	}
	String.prototype.toInt = function() {
		var num = parseInt(this);
		return isNaN(num) ? 0 : num;
	}
	String.prototype.toFloat = function() {
		var num = parseFloat(this);
		return isNaN(num) ? 0 : num;
	}
	String.prototype.strCut = function(len) {
		var string = this;
		return string.length > len ? string.substr(0, len - 3) + ' ...' : string;
	}
	String.prototype.ucFirst = function() {
		var string = this;
		return string[0].toUpperCase() + string.substr(1);
	}
	String.prototype.replaceAll = function(from, to) {
		var string = this;
		for(var i in from) {
			var regexp = new RegExp(from[i], 'g');
			string = string.replace(regexp, to[i]);
		}
		return string;
	}
	
	// 字符格式化
	String.prototype.number_format = Number.prototype.number_format = function (decimals, decPoint, thousandsSep) {
		var number = this;
		number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
		var n = !isFinite(+number) ? 0 : +number
		var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
		var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
		var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
		var s = ''
		
		var toFixedFix = function (n, prec) {
			var k = Math.pow(10, prec)
			return '' + (Math.round(n * k) / k)
			  .toFixed(prec)
		}
		
		// @todo: for IE parseFloat(0.55).toFixed(0) = 0;
		s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
		if (s[0].length > 3) {
			s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
		}
		if ((s[1] || '').length < prec) {
			s[1] = s[1] || ''
			s[1] += new Array(prec - s[1].length + 1).join('0')
		}
		
		return s.join(dec);
	};
	
	e.jQuery.fn.extend({  
		chkvals:function () {  
			var chkedVals = [];
			$(this).each(function(index, element) {
                if($(this).prop('checked')) chkedVals.push($(this).val());
            }); 
			return chkedVals;
		},
		vals: function () {
			var vals = [];	
			$(this).each(function(index, element) {
                vals.push($(this).val());
            }); 
			return vals;
		},
		// 扩展属性
		tips: function (content, p) {
			p = i.extend({
				  tips: [1, '#3595CC'],
				  time: 4000
				}, p||{});
			r.tips(content, this, p);
		}
	});
	
    var i, n, a = e.layui && layui.define,
    o = {
        getPath: function() {
            var e = document.scripts,
            t = e[e.length - 1],
            i = t.src;
            if (!t.getAttribute("merge")) return i.substring(0, i.lastIndexOf("/") + 1)
        } (),
        config: {
			verify_regexp: {	// 默认验证规则
				email: /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9_\.\-]+$/,		// 邮箱 
				phone: /^[\+\-\d]{4, 20}$/		// 手机 
			},
			formDefault: {		// 表格内容默认属性
				key: null,		// 收集数据时的key值
				name: null, 	// 标签名
				notice: '', 	// -n 标签 输入说明
				before: null, 	// -b 在哪个标签前面  // 添加行时使用
				type: 'text',	// -t 类型 (textarea|text|password|select|radio|checkbox|html|rowhtml)	// html 还是有标签和内容区分，rowhtml内容占一整行
				show: true,		// -s 是否显示
				placeholder: '', // -p placeholder
				
				val: null,		// -v 默认值
				val_format: null,	// 值格式化
				val_type: 'string',	// 默认值类型 （array|object|string|int|float[length, digit]）
				required: false, // 是否必填项
				verify: null,	// -i 选项验证 正则表达式 亦可 是类型选项: email|phone
				error: '',		// 验证结果：正确为空，错误为提示内容
				max: null,		// -r=min,max,digit string[最大长度] int|float[最大值]
				min: null,		// -r=min,max,digit string[最小长度] int[最小值]
				digit: 2		// -r=min,max,digit float 小数位数
				
				// 运行的事件绑定
				// ['click', 'dblclick', 'change', 'mouseover', 'mouseout', 'keyup', 'keydown']
			}
		},
        end: {},
        minIndex: 0,
        minLeft: [],
        btn: ["&#x786E;&#x5B9A;", "&#x53D6;&#x6D88;"],
        type: ["dialog", "page", "iframe", "loading", "tips", "form"]
    },
    r = {
        v: "3.0.1",
        ie: function() {
            var t = navigator.userAgent.toLowerCase();
            return !! (e.ActiveXObject || "ActiveXObject" in e) && ((t.match(/msie\s(\d+)/) || [])[1] || "11")
        } (),
        index: e.layer && e.layer.v ? 1e5: 0,
        path: o.getPath,
        config: function(e, t) {
            return e = e || {},
            r.cache = o.config = i.extend({},
            o.config, e),
            r.path = o.config.path || r.path,
            "string" == typeof e.extend && (e.extend = [e.extend]),
            o.config.path && r.ready(),
            e.extend ? (a ? layui.addcss("modules/layer/" + e.extend) : r.link("skin/" + e.extend), this) : this
        },
        link: function(t, n, a) {
            if (r.path) {
                var o = i("head")[0],
                l = document.createElement("link");
                "string" == typeof n && (a = n);
                var s = (a || t).replace(/\.|\//g, ""),
                f = "layuicss-" + s,
                c = 0;
                l.rel = "stylesheet",
                l.href = r.path + t,
                l.id = f,
                i("#" + f)[0] || o.appendChild(l),
                "function" == typeof n && !
                function d() {
                    return++c > 80 ? e.console && console.error("layer.css: Invalid") : void(1989 === parseInt(i("#" + f).css("width")) ? n() : setTimeout(d, 100))
                } ()
            }
        },
        ready: function(e) {
            var t = "skinlayercss",
            i = "1110";
            return a ? layui.addcss("modules/layer/default/layer.css?v=" + r.v + i, e, t) : r.link("skin/default/layer.css?v=" + r.v + i, e, t),
            this
        },
        alert: function(e, t, n) {
            var a = "function" == typeof t;
            return a && (n = t),
            r.open(i.extend({
                title: '提示',
                content: e,
                yes: n
            },
            a ? {}: t))
        },
        confirm: function(e, t, n, a) {
            var l = "function" == typeof t;
            return l && (a = n, n = t),
            r.open(i.extend({
                content: e,
                btn: o.btn,
                yes: n,
                btn2: a
            },
            l ? {}: t))
        },
        msg: function(e, n, a) {
            var l = "function" == typeof n,
            f = o.config.skin,
            c = (f ? f + " " + f + "-msg": "") || "layui-layer-msg",
            d = s.anim.length - 1;
            return l && (a = n),
            r.open(i.extend({
                content: e,
                time: 3e3,
                shade: !1,
                skin: c,
                title: !1,
                closeBtn: !1,
                btn: !1,
                resize: !1,
                end: a
            },
            l && !o.config.skin ? {
                skin: c + " layui-layer-hui",
                anim: d
            }: function() {
                return n = n || {},
                (n.icon === -1 || n.icon === t && !o.config.skin) && (n.skin = c + " " + (n.skin || "layui-layer-hui")),
                n
            } ()))
        },
        load: function(e, t) {
            return r.open(i.extend({
                type: 3,
                icon: e || 0,
                resize: !1,
                shade: .01
            },
            t))
        },
        tips: function(e, t, n) {
            return r.open(i.extend({
                type: 4,
                content: [e, t],
                closeBtn: !1,
                time: 3e3,
                shade: !1,
                resize: !1,
                fixed: !1,
                maxWidth: 210
            },
            n))
        }
    },
    l = function(e) {
        var t = this;
        t.index = ++r.index,
        t.config = i.extend({}, t.config, o.config, e),
		e.form && (t.form = e.form) && (delete t.config.form) && (t.formInit()),	// 表格数据格式化
        document.body ? t.creat() : setTimeout(function() {
            t.creat()
        },
        50)
    };
    
    e.jQuery.layer = r;
	
    l.pt = l.prototype;
    var s = ["layui-layer", ".layui-layer-title", ".layui-layer-main", ".layui-layer-dialog", "layui-layer-iframe", "layui-layer-content", "layui-layer-btn", "layui-layer-close"];
    s.anim = ["layer-anim", "layer-anim-01", "layer-anim-02", "layer-anim-03", "layer-anim-04", "layer-anim-05", "layer-anim-06"],
	
	// 表单数据设置
	l.pt.formInit = function () {
		var t = this;
		t.form.__form = $('<div class="layui-form"></div>');
		t.formRowsAdd(t.form || {});
		return this;
	};
	
	// Form 一行数据初始化
	l.pt.formRowConfig = function (key, row) {
		var t = this;
		if(typeof row == 'string') {
			var _options = row.split('|');
			var _row = {
				key	 : key,
				name : _options[0]
			}
			
			for(var k in _options) {
				if(k == 0) continue;
				
				var value = _options[k];
				if(value == 'required') {
					// 必填
					_row.required = true;
					continue;
				}
				
				// 判断是否有关键词
				switch(value) {
					case 'required':
						_row.required = true;
						break;
					case 'int':
					case 'string':
					case 'float':
					case 'array':
					case 'object':
						_row.val_type = value;
						break;
					default:
						// 根据关键词前缀判断值
						var keyCode = value.substr(0, 2);
							value 	= value.substr(2);
						switch(keyCode) {
							case 'r=':
								// 范围
								var valRange = value.split(',');
								_row.min = valRange[0];
								_row.max = valRange[1];
								_row.digit = valRange[2];
								break;
							case 'v=':
								_row.val = value;
								break;
							case '~=':
								_row.val_format = value;
								break;
							case 'o=':
								eval('value='+value+';');
								_row.options = value;
								break;
							case 't=':
								_row.type = value;
								break;
							case 'i=':
								_row.verify = value;
								break;
							case 'b=':
								_row.before = value;
								break;
							case 'n=':
								_row.notice = value;
								break;
							case 'p=':
								_row.plaseholder = value;
								break;
						}
				}
			}
		} else {
			var _row = row;
			row.key = key;
		}
		
		t.form[key] = i.extend({}, o.config.formDefault, (t.form[key] || {}), _row);
		
		// 初始化值 与 类型
		// text|password|select|radio|checkbox|html|rowhtml
		switch(t.form[key].type) {
			case 'text':
			case 'password':
			case 'textarea':
			case 'select':
			case 'radio':
				if(!t.form[key].val) t.form[key].val = t.form[key].val_type == 'string' ? '' : 0;
				break;
			case 'checkbox':
				if(!t.form[key].val) t.form[key].val = [];
				break;
		}
		return this;
	};
	
	// 表单数据验证
	l.pt.formRowVerify = function (key) {
		var t = this;
		var row = t.form[key];
		switch(row.val_type) {
			case 'int':
			case 'float':
				// 数字类型
				if((row.min !== null && row.val < row.min) || (row.max !== null && row.val > row.max)) {
					row.error = '「'+row.name+'」';
					switch(true) {
						case row.min === null:
							row.error += ' 选项最大值为 ' + row.max;
						break;
						case row.max === null:
							row.error += ' 选项最小值为 ' + row.min;
						break;
						default:
							row.error += ' 选项范围为 ' + row.min + ' ~ ' + row.max;
						break;
					}
					t.formRowResetError(key);
					return false;
				}
				break;
			case 'string':
				if(row.required && row.val == '') {
					row.error = '「'+row.name+'」不可为空';
					t.formRowResetError(key);
					return false;
				}
				if((row.min && row.val.length < row.min) || (row.max && row.val.length > row.max)) {
					row.error = '「'+row.name+'」';
					switch(true) {
						case row.min === null:
							row.error += '长度不可超过' + row.max + '位';
						break;
						case row.max === null:
							row.error += '长度不可小于' + row.min + '位';
						break;
						default:
							row.error += '长度范围为' + row.min + ' ~ ' + row.max + '位';
						break;
					}
					t.formRowResetError(key);
					return false;
				}
				if(row.verify) {
					var reg = typeof row.verify == 'object' ? row.verify : o.config.verify_regexp[row.verify];
					if(!reg.test(row.val)) {
						row.error = '「'+row.name+'」格式错误';
						t.formRowResetError(key);
						return false;
					}
				}
				break;
			case 'array':
				if(row.required && row.val.length == 0) {
					row.error = '「'+row.name+'」为必选项';
					t.formRowResetError(key);
					return false;
				}
				break;
		}
		
		// 通过验证
		row.error = '';
		t.formRowResetError(key);
		return true;
	}
	
	// 显示错误信息
	l.pt.formRowResetError = function (key) {
		this.form[key].e.find('.tips').html(this.form[key].error);
		return this;
	}
	
	// 获取表单所有数据
	// text|password|select|radio|checkbox|html|rowhtml
	l.pt.formData = function () {
		var t = this;
		var f = t.form;
		var d = {};
		for(var k in f) {
			switch(f[k].type) {
				case 'text':
				case 'textarea':
				case 'password':
				case 'select':
				case 'radio':
				case 'checkbox':
					if(!t.formRowVerify(k)) return false;
					d[k] = f[k].val;
					break;
				default:;
			}
		}
		return d;
	}
	
	// Form 组装
	l.pt.formRowInit = function (key) {
		var t = this;
		if(t.form[key].e) {
			// 已有的替换
			var n = i(t.formRowHtml(key));
			t.form[key].e.replaceWith(n);
			t.form[key].e = n;
		} else {
			// 没有新加
			t.form[key].e = i(t.formRowHtml(key));
			if(t.form[key].before) {
				t.form[t.form[key].before].e.before(t.form[key].e);
			} else {
				t.form[key].e.appendTo(t.form.__form);
			}
		}
		
		/***** 添加监听事件 *****/
		var c = t.form[key];
		// text|password|textarea|select|radio|checkbox|html|rowhtml
		switch(c.type) {
			case 'text':
			case 'textarea':
			case 'password':
				c.e.find('input, textarea').keyup(function () {
					// 数字类型
					if(c.val_type == 'int' || c.val_type == 'float') {
						var val = $(this).val();
						var dot = val[val.length - 1] == '.';
						val = c.val_type == 'int' ? val.toInt() : val.toFloat().round(c.digit);
						// c.min && (val = Math.max(c.min, val));
						c.max && (val = Math.min(c.max, val));
						
						c.val = val;
						$(this).val(val + (dot ? '.' : ''));
						t.formRowVerify(key);
					
					// 字符串类型
					} else {
						c.val = $(this).val().trim();
						t.formRowVerify(c.key);
					}
				});
				break;
			case 'select':
				c.e.find('select').change(function () {
					c.val = $(this).val();
					t.formRowVerify(key);
				});
				break;
			case 'radio':
				c.e.find('input').click(function () {
					c.val = $(this).val();
					t.formRowVerify(c.key);
				});
				break;
			case 'checkbox':
				c.e.change(function () {
					c.val = $(this).find('input').chkvals();
					t.formRowVerify(c.key);
				});
				break;
			default:
		}
		
		// 添加自定义事件
		var allowEvents = ['click', 'dblclick', 'change', 'mouseover', 'mouseout', 'keyup', 'keydown'];
		for(var k in allowEvents) {
			var ename = allowEvents[k];
			if(!c[ename]) continue;
			
			var callback = c[ename];
			c.e.on(ename, function () {
				(callback)(c, t, ...arguments);
			});
			
		}
		return this;
	};
	
	l.pt.formRowHtml = function (key) {
		var t = this;
		var e = t.form[key];
		var c = t.config;
		var html = '<div class="layui-form-item">';
    	if(e.type == 'rowhtml') {
			html += '<blockquote class="layui-elem-quote">'+e.name+'</blockquote>';
			return html += '</div>';
		}
		
		html += '<label class="layui-form-label" style="width:'+c.cols[0]+';'+(c.cols[0] == '100%' ? 'text-align:left;' : '')+'">'+(e.required ? '* ' : '')+e.name+(e.notice ? '<em class="layui-form-notice">「'+e.notice+'」</em>' : '')+': </label>';
		html += '<div class="layui-input-block" style="width:'+c.cols[1]+'">';
		
		// 对有选项的，指定选项的 键 & 值
		if(e.options) {
			var os = {};
			for(var k in e.options) {
				var _val = e.options[k];
				var _key = e.option_key ? _val[e.option_key] : k;
				var _val = e.option_val ? _val[e.option_val] : _val;
				os[_key] = _val;
			}
		}
		switch(e.type) {
			case 'html':
				html += e.val;	
				break;
			case 'text':
			case 'password':
				// 值初始化
				e.val = e.val === null ? '' : e.val;
     			html += '<input name="'+e.key+'" value="' + e.val + '" placeholder="'+e.placeholder+'" autocomplete="off" class="layui-layer-input '+e.key+'" type="'+e.type+'">';
				break;
			case 'textarea':
				// 值初始化
				e.val = e.val === null ? '' : e.val;
				html += '<textarea class="layui-layer-input '+e.key+'" '+(e.height ? 'style="height: '+e.height+'"' : '')+'>' + e.val + "</textarea>";
				break;
			case 'select':
				html += '<select class="layui-layer-select '+e.key+'" '+(e.width ? 'style="width: '+e.width+'"' : '')+'>';
				for(var k in os) {
					html += '<option value="'+k+'" '+(k == e.val ? 'selected="selected"' : '')+'>'+os[k]+'</option>';
				}
				html += '</select>';
				break;
			case 'checkbox':
				// 值初始化
				e.val = e.val === null ? [] : e.val;
				for(var k in os) {
					html += '<div class="layui-layer-checkbox" '+(e.width ? 'style="width: '+e.width+'"' : '')+'><input type="checkbox" class="'+e.key+'" value="'+k+'" ';
					html += (e.val && e.val.indexOf(k) > -1 ? 'checked="checked"' : '')+' /> '+os[k]+'</div>';
				}
				break;
			case 'radio':
				for(var k in os) {
					html += '<div class="layui-layer-radio" '+(e.width ? 'style="width: '+e.width+'"' : '')+'><input type="radio" name="layui-name-'+e.key+'" class="'+e.key+'" value="'+k+'" ';
					html += (k == e.val ? 'checked="checked"' : '')+' /> '+os[k]+'</div>';
				}
				break;
		}
		html += '<div class="tips"></div>';
    	html += '</div>';
 		html += '</div>';
		return html;
	};
	
	// 添加 f:表单数据格式同创建时
	l.pt.formRowsAdd = function (f) {
		var t = this;
		for(var key in f) {
			// 钩子函数 支持（__begin, __init, _end）
			if(key.substr(0, 2) == '__' && (t.form[key] = f[key])) continue;
			
			// 表单项初始化
			t.formRowConfig(key, f[key]);
			t.formRowInit(key);
		}
		return this;
	};
	
	// 修改一行
	l.pt.formRowChange = function (key, data) {
		var t = this;
		t.form[key] = i.extend(t.form[key], data);
		t.formRowInit(key);
		return this;
	};
	
	// 移除一行
	l.pt.formRowRemove = function (key) {
		var t = this;
		// 删除节点
		t.form[key].e.remove();
		// 删除数据
		delete t.form[key];
		return this;
	};
	
    l.pt.config = {
        type: 0,
        shade: .3,
        fixed: !0,
        move: s[1],
        title: "&#x4FE1;&#x606F;",
        offset: "auto",
        area: "auto",
        closeBtn: 1,
        time: 0,
        zIndex: 19891014,
        maxWidth: 360,
        anim: 0,
        icon: -1,
        moveType: 1,
        resize: !0,
        scrollbar: !0,
        tips: 2
    },
    l.pt.vessel = function(e, t) {
        var n = this,
        a = n.index,
        r = n.config,
        l = r.zIndex + a,
        f = "object" == typeof r.title,
        c = r.maxmin && (1 === r.type || 2 === r.type || 5 === r.type),
        d = r.title ? '<div class="layui-layer-title" style="' + (f ? r.title[1] : "") + '">' + (f ? r.title[0] : r.title) + "</div>": "";
        return r.zIndex = l,
        t([r.shade ? '<div class="layui-layer-shade" id="layui-layer-shade' + a + '" times="' + a + '" style="' + ("z-index:" + (l - 1) + "; background-color:" + (r.shade[1] || "#000") + "; opacity:" + (r.shade[0] || r.shade) + "; filter:alpha(opacity=" + (100 * r.shade[0] || 100 * r.shade) + ");") + '"></div>': "", '<div class="' + s[0] + (" layui-layer-" + o.type[r.type]) + (0 != r.type && 2 != r.type || r.shade ? "": " layui-layer-border") + " " + (r.skin || "") + '" id="' + s[0] + a + '" type="' + o.type[r.type] + '" times="' + a + '" showtime="' + r.time + '" conType="' + (e ? "object": "string") + '" style="z-index: ' + l + "; width:" + r.area[0] + ";height:" + r.area[1] + (r.fixed ? "": ";position:absolute;") + '">' + (e && 2 != r.type ? "": d) + '<div id="' + (r.id || "") + '" class="layui-layer-content' + (0 == r.type && r.icon !== -1 ? " layui-layer-padding": "") + (3 == r.type ? " layui-layer-loading" + r.icon: "") + '">' + (0 == r.type && r.icon !== -1 ? '<i class="layui-layer-ico layui-layer-ico' + r.icon + '"></i>': "") + (1 == r.type && e ? "": r.content || "") + '</div><span class="layui-layer-setwin">' +
        function() {
            var e = c ? '<a class="layui-layer-min" href="javascript:;"><cite></cite></a><a class="layui-layer-ico layui-layer-max" href="javascript:;"></a>': "";
            return r.closeBtn && (e += '<a class="layui-layer-ico ' + s[7] + " " + s[7] + (r.title ? r.closeBtn: 4 == r.type ? "1": "2") + '" href="javascript:;"></a>'),
            e
        } () + "</span>" + (r.btn ?
        function() {
            var e = "";
            "string" == typeof r.btn && (r.btn = [r.btn]);
            for (var t = 0,
            i = r.btn.length; t < i; t++) e += '<a class="' + s[6] + t + '">' + r.btn[t] + "</a>";
            return '<div class="' + s[6] + " layui-layer-btn-" + (r.btnAlign || "") + '">' + e + "</div>"
        } () : "") + (r.resize ? '<span class="layui-layer-resize"></span>': "") + "</div>"], d, i('<div class="layui-layer-move"></div>')),
        n
    },
    l.pt.creat = function() {
        var e = this,
        t = e.config,
        a = e.index,
        l = t.content,
        f = "object" == typeof l,
        c = i("body");
		
        if (!i("#" + t.id)[0]) {
            switch ("string" == typeof t.area && (t.area = "auto" === t.area ? ["", ""] : [t.area, ""]), t.shift && (t.anim = t.shift), 6 == r.ie && (t.fixed = !1), t.type) {
            case 0:
                t.btn = "btn" in t ? t.btn: o.btn[0],
                r.closeAll("dialog");
                break;
            case 2:
                var l = t.content = f ? t.content: [t.content || "http://layer.layui.com", "auto"];
                t.content = '<iframe scrolling="' + (t.content[1] || "auto") + '" allowtransparency="true" id="' + s[4] + a + '" name="' + s[4] + a + '" onload="this.className=\'\';" class="layui-layer-load" frameborder="0" src="' + t.content[0] + '"></iframe>';
                break;
            case 3:
                delete t.title,
                delete t.closeBtn,
                t.icon === -1 && 0 === t.icon,
                r.closeAll("loading");
                break;
            case 4:
                f || (t.content = [t.content, "body"]),
                t.follow = t.content[1],
                t.content = t.content[0] + '<i class="layui-layer-TipsG"></i>',
                delete t.title,
                t.tips = "object" == typeof t.tips ? t.tips: [t.tips, !0],
                t.tipsMore || r.closeAll("tips")
			case 5:
				// 表格
                break;
            }
            e.vessel(f, function(n, r, d) {
                c.append(n[0]),
                f ?
                function() {
                    2 == t.type || 4 == t.type ?
                    function() {
                        i("body").append(n[1])
                    } () : function() {
                        l.parents("." + s[0])[0] || (l.data("display", l.css("display")).show().addClass("layui-layer-wrap").wrap(n[1]), i("#" + s[0] + a).find("." + s[5]).before(r))
                    } ()
                } () : c.append(n[1]),
                i(".layui-layer-move")[0] || c.append(o.moveElem = d),
                e.layero = i("#" + s[0] + a),
				e.form && (e.layero.children('.layui-layer-content').append(e.form.__form)),
                t.scrollbar || s.html.css("overflow", "hidden").attr("layer-full", a)
            }).auto(a),
            2 == t.type && 6 == r.ie && e.layero.find("iframe").attr("src", l[0]),
            4 == t.type ? e.tips() : e.offset(),
            t.fixed && n.on("resize",
            function() {
                e.offset(),
                (/^\d+%$/.test(t.area[0]) || /^\d+%$/.test(t.area[1])) && e.auto(a),
                4 == t.type && e.tips()
            }),
            t.time <= 0 || setTimeout(function() {
                r.close(e.index)
            },
            t.time),
            e.move().callback(),
            s.anim[t.anim] && e.layero.addClass(s.anim[t.anim]).data("anim", !0)
        }
    },
    l.pt.auto = function(e) {
        function t(e) {
            e = l.find(e),
            e.height(f[1] - c - d - 2 * (0 | parseFloat(e.css("padding"))))
        }
        var a = this,
        o = a.config,
        l = i("#" + s[0] + e);
        "" === o.area[0] && o.maxWidth > 0 && (r.ie && r.ie < 8 && o.btn && l.width(l.innerWidth()), l.outerWidth() > o.maxWidth && l.width(o.maxWidth));
        var f = [l.innerWidth(), l.innerHeight()],
        c = l.find(s[1]).outerHeight() || 0,
        d = l.find("." + s[6]).outerHeight() || 0;
        switch (o.type) {
        case 2:
            t("iframe");
            break;
		case 5:
			break;
        default:
            "" === o.area[1] ? o.fixed && f[1] >= n.height() && (f[1] = n.height(), t("." + s[5])) : t("." + s[5])
        }
        return a
    },
    l.pt.offset = function() {
        var e = this,
        t = e.config,
        i = e.layero,
        a = [i.outerWidth(), i.outerHeight()],
        o = "object" == typeof t.offset;
        e.offsetTop = (n.height() - a[1]) / 2,
        e.offsetLeft = (n.width() - a[0]) / 2,
        o ? (e.offsetTop = t.offset[0], e.offsetLeft = t.offset[1] || e.offsetLeft) : "auto" !== t.offset && ("t" === t.offset ? e.offsetTop = 0 : "r" === t.offset ? e.offsetLeft = n.width() - a[0] : "b" === t.offset ? e.offsetTop = n.height() - a[1] : "l" === t.offset ? e.offsetLeft = 0 : "lt" === t.offset ? (e.offsetTop = 0, e.offsetLeft = 0) : "lb" === t.offset ? (e.offsetTop = n.height() - a[1], e.offsetLeft = 0) : "rt" === t.offset ? (e.offsetTop = 0, e.offsetLeft = n.width() - a[0]) : "rb" === t.offset ? (e.offsetTop = n.height() - a[1], e.offsetLeft = n.width() - a[0]) : e.offsetTop = t.offset),
        t.fixed || (e.offsetTop = /%$/.test(e.offsetTop) ? n.height() * parseFloat(e.offsetTop) / 100 : parseFloat(e.offsetTop), e.offsetLeft = /%$/.test(e.offsetLeft) ? n.width() * parseFloat(e.offsetLeft) / 100 : parseFloat(e.offsetLeft), e.offsetTop += n.scrollTop(), e.offsetLeft += n.scrollLeft()),
        i.attr("minLeft") && (e.offsetTop = n.height() - (i.find(s[1]).outerHeight() || 0), e.offsetLeft = i.css("left")),
        i.css({
            top: e.offsetTop,
            left: e.offsetLeft
        })
    },
    l.pt.tips = function() {
        var e = this,
        t = e.config,
        a = e.layero,
        o = [a.outerWidth(), a.outerHeight()],
        r = i(t.follow);
        r[0] || (r = i("body"));
        var l = {
            width: r.outerWidth(),
            height: r.outerHeight(),
            top: r.offset().top,
            left: r.offset().left
        },
        f = a.find(".layui-layer-TipsG"),
        c = t.tips[0];
        t.tips[1] || f.remove(),
        l.autoLeft = function() {
            l.left + o[0] - n.width() > 0 ? (l.tipLeft = l.left + l.width - o[0], f.css({
                right: 12,
                left: "auto"
            })) : l.tipLeft = l.left
        },
        l.where = [function() {
            l.autoLeft(),
            l.tipTop = l.top - o[1] - 10,
            f.removeClass("layui-layer-TipsB").addClass("layui-layer-TipsT").css("border-right-color", t.tips[1])
        },
        function() {
            l.tipLeft = l.left + l.width + 10,
            l.tipTop = l.top,
            f.removeClass("layui-layer-TipsL").addClass("layui-layer-TipsR").css("border-bottom-color", t.tips[1])
        },
        function() {
            l.autoLeft(),
            l.tipTop = l.top + l.height + 10,
            f.removeClass("layui-layer-TipsT").addClass("layui-layer-TipsB").css("border-right-color", t.tips[1])
        },
        function() {
            l.tipLeft = l.left - o[0] - 10,
            l.tipTop = l.top,
            f.removeClass("layui-layer-TipsR").addClass("layui-layer-TipsL").css("border-bottom-color", t.tips[1])
        }],
        l.where[c - 1](),
        1 === c ? l.top - (n.scrollTop() + o[1] + 16) < 0 && l.where[2]() : 2 === c ? n.width() - (l.left + l.width + o[0] + 16) > 0 || l.where[3]() : 3 === c ? l.top - n.scrollTop() + l.height + o[1] + 16 - n.height() > 0 && l.where[0]() : 4 === c && o[0] + 16 - l.left > 0 && l.where[1](),
        a.find("." + s[5]).css({
            "background-color": t.tips[1],
            "padding-right": t.closeBtn ? "30px": ""
        }),
        a.css({
            left: l.tipLeft - (t.fixed ? n.scrollLeft() : 0),
            top: l.tipTop - (t.fixed ? n.scrollTop() : 0)
        })
    },
    l.pt.move = function() {
        var e = this,
        t = e.config,
        a = i(document),
        l = e.layero,
        s = l.find(t.move),
        f = l.find(".layui-layer-resize"),
        c = {};
        return t.move && s.css("cursor", "move"),
        s.on("mousedown",
        function(e) {
            e.preventDefault(),
            t.move && (c.moveStart = !0, c.offset = [e.clientX - parseFloat(l.css("left")), e.clientY - parseFloat(l.css("top"))], o.moveElem.css("cursor", "move").show())
        }),
        f.on("mousedown",
        function(e) {
            e.preventDefault(),
            c.resizeStart = !0,
            c.offset = [e.clientX, e.clientY],
            c.area = [l.outerWidth(), l.outerHeight()],
            o.moveElem.css("cursor", "se-resize").show()
        }),
        a.on("mousemove",
        function(i) {
            if (c.moveStart) {
                var a = i.clientX - c.offset[0],
                o = i.clientY - c.offset[1],
                s = "fixed" === l.css("position");
                if (i.preventDefault(), c.stX = s ? 0 : n.scrollLeft(), c.stY = s ? 0 : n.scrollTop(), !t.moveOut) {
                    var f = n.width() - l.outerWidth() + c.stX,
                    d = n.height() - l.outerHeight() + c.stY;
                    a < c.stX && (a = c.stX),
                    a > f && (a = f),
                    o < c.stY && (o = c.stY),
                    o > d && (o = d)
                }
                l.css({
                    left: a,
                    top: o
                })
            }
            if (t.resize && c.resizeStart) {
                var a = i.clientX - c.offset[0],
                o = i.clientY - c.offset[1];
                i.preventDefault(),
                r.style(e.index, {
                    width: c.area[0] + a,
                    height: c.area[1] + o
                }),
                c.isResize = !0
            }
        }).on("mouseup",
        function(e) {
            c.moveStart && (delete c.moveStart, o.moveElem.hide(), t.moveEnd && t.moveEnd()),
            c.resizeStart && (delete c.resizeStart, o.moveElem.hide())
        }),
        e
    },
    l.pt.callback = function() {
        function e() {
            var e = a.cancel && a.cancel(t.index, n);
            e === !1 || r.close(t.index)
        }
        var t = this,
        n = t.layero,
        a = t.config;
        t.openLayer(),
        a.success && (2 == a.type ? n.find("iframe").on("load",
        function() {
            a.success(n, t.index)
        }) : a.success(n, t.index)),
        6 == r.ie && t.IE6(n),
        n.find("." + s[6]).children("a").on("click",
        function() {
            var e = i(this).index();
            if (0 === e) a.yes ? a.yes(t.index, n, t) : a.btn1 ? a.btn1(t.index, n) : r.close(t.index);
            else {
                var o = a["btn" + (e + 1)] && a["btn" + (e + 1)](t.index, n);
                o === !1 || r.close(t.index)
            }
        }),
        n.find("." + s[7]).on("click", e),
        a.shadeClose && i("#layui-layer-shade" + t.index).on("click",
        function() {
            r.close(t.index)
        }),
        n.find(".layui-layer-min").on("click",
        function() {
            var e = a.min && a.min(n);
            e === !1 || r.min(t.index, a)
        }),
        n.find(".layui-layer-max").on("click",
        function() {
            i(this).hasClass("layui-layer-maxmin") ? (r.restore(t.index), a.restore && a.restore(n)) : (r.full(t.index, a), setTimeout(function() {
                a.full && a.full(n)
            },
            100))
        }),
        a.end && (o.end[t.index] = a.end)
    },
    o.reselect = function() {
        i.each(i("select"),
        function(e, t) {
            var n = i(this);
            n.parents("." + s[0])[0] || 1 == n.attr("layer") && i("." + s[0]).length < 1 && n.removeAttr("layer").show(),
            n = null
        })
    },
    l.pt.IE6 = function(e) {
        i("select").each(function(e, t) {
            var n = i(this);
            n.parents("." + s[0])[0] || "none" === n.css("display") || n.attr({
                layer: "1"
            }).hide(),
            n = null
        })
    },
    l.pt.openLayer = function() {
        var e = this;
        r.zIndex = e.config.zIndex,
        r.setTop = function(e) {
            var t = function() {
                r.zIndex++,
                e.css("z-index", r.zIndex + 1)
            };
            return r.zIndex = parseInt(e[0].style.zIndex),
            e.on("mousedown", t),
            r.zIndex
        }
    },
    o.record = function(e) {
        var t = [e.width(), e.height(), e.position().top, e.position().left + parseFloat(e.css("margin-left"))];
        e.find(".layui-layer-max").addClass("layui-layer-maxmin"),
        e.attr({
            area: t
        })
    },
    o.rescollbar = function(e) {
        s.html.attr("layer-full") == e && (s.html[0].style.removeProperty ? s.html[0].style.removeProperty("overflow") : s.html[0].style.removeAttribute("overflow"), s.html.removeAttr("layer-full"))
    },
    e.layer = r,
    r.getChildFrame = function(e, t) {
        return t = t || i("." + s[4]).attr("times"),
        i("#" + s[0] + t).find("iframe").contents().find(e)
    },
    r.getFrameIndex = function(e) {
        return i("#" + e).parents("." + s[4]).attr("times")
    },
    r.iframeAuto = function(e) {
        if (e) {
            var t = r.getChildFrame("html", e).outerHeight(),
            n = i("#" + s[0] + e),
            a = n.find(s[1]).outerHeight() || 0,
            o = n.find("." + s[6]).outerHeight() || 0;
            n.css({
                height: t + a + o
            }),
            n.find("iframe").css({
                height: t
            })
        }
    },
    r.iframeSrc = function(e, t) {
        i("#" + s[0] + e).find("iframe").attr("src", t)
    },
    r.style = function(e, t, n) {
        var a = i("#" + s[0] + e),
        r = a.find(".layui-layer-content"),
        l = a.attr("type"),
        f = a.find(s[1]).outerHeight() || 0,
        c = a.find("." + s[6]).outerHeight() || 0;
        a.attr("minLeft");
        l !== o.type[3] && l !== o.type[4] && (n || (parseFloat(t.width) <= 260 && (t.width = 260), parseFloat(t.height) - f - c <= 64 && (t.height = 64 + f + c)), a.css(t), c = a.find("." + s[6]).outerHeight(), l === o.type[2] ? a.find("iframe").css({
            height: parseFloat(t.height) - f - c
        }) : r.css({
            height: parseFloat(t.height) - f - c - parseFloat(r.css("padding-top")) - parseFloat(r.css("padding-bottom"))
        }))
    },
    r.min = function(e, t) {
        var a = i("#" + s[0] + e),
        l = a.find(s[1]).outerHeight() || 0,
        f = a.attr("minLeft") || 181 * o.minIndex + "px",
        c = a.css("position");
        o.record(a),
        o.minLeft[0] && (f = o.minLeft[0], o.minLeft.shift()),
        a.attr("position", c),
        r.style(e, {
            width: 180,
            height: l,
            left: f,
            top: n.height() - l,
            position: "fixed",
            overflow: "hidden"
        },
        !0),
        a.find(".layui-layer-min").hide(),
        "page" === a.attr("type") && a.find(s[4]).hide(),
        o.rescollbar(e),
        a.attr("minLeft") || o.minIndex++,
        a.attr("minLeft", f)
    },
    r.restore = function(e) {
        var t = i("#" + s[0] + e),
        n = t.attr("area").split(",");
        t.attr("type");
        r.style(e, {
            width: parseFloat(n[0]),
            height: parseFloat(n[1]),
            top: parseFloat(n[2]),
            left: parseFloat(n[3]),
            position: t.attr("position"),
            overflow: "visible"
        },
        !0),
        t.find(".layui-layer-max").removeClass("layui-layer-maxmin"),
        t.find(".layui-layer-min").show(),
        "page" === t.attr("type") && t.find(s[4]).show(),
        o.rescollbar(e)
    },
    r.full = function(e) {
        var t, a = i("#" + s[0] + e);
        o.record(a),
        s.html.attr("layer-full") || s.html.css("overflow", "hidden").attr("layer-full", e),
        clearTimeout(t),
        t = setTimeout(function() {
            var t = "fixed" === a.css("position");
            r.style(e, {
                top: t ? 0 : n.scrollTop(),
                left: t ? 0 : n.scrollLeft(),
                width: n.width(),
                height: n.height()
            },
            !0),
            a.find(".layui-layer-min").hide()
        },
        100)
    },
    r.title = function(e, t) {
        var n = i("#" + s[0] + (t || r.index)).find(s[1]);
        n.html(e)
    },
    r.close = function(e) {
        var t = i("#" + s[0] + e),
        n = t.attr("type"),
        a = "layer-anim-close";
        if (t[0]) {
            var l = "layui-layer-wrap",
            f = function() {
                if (n === o.type[1] && "object" === t.attr("conType")) {
                    t.children(":not(." + s[5] + ")").remove();
                    for (var a = t.find("." + l), r = 0; r < 2; r++) a.unwrap();
                    a.css("display", a.data("display")).removeClass(l)
                } else {
                    if (n === o.type[2]) try {
                        var f = i("#" + s[4] + e)[0];
                        f.contentWindow.document.write(""),
                        f.contentWindow.close(),
                        t.find("." + s[5])[0].removeChild(f)
                    } catch(c) {}
                    t[0].innerHTML = "",
                    t.remove()
                }
                "function" == typeof o.end[e] && o.end[e](),
                delete o.end[e]
            };
            t.data("anim") && t.addClass(a),
            i("#layui-layer-moves, #layui-layer-shade" + e).remove(),
            6 == r.ie && o.reselect(),
            o.rescollbar(e),
            t.attr("minLeft") && (o.minIndex--, o.minLeft.push(t.attr("minLeft"))),
            setTimeout(function() {
                f()
            },
            r.ie && r.ie < 10 || !t.data("anim") ? 0 : 200)
        }
    },
    r.closeAll = function(e) {
        i.each(i("." + s[0]),
        function() {
            var t = i(this),
            n = e ? t.attr("type") === e: 1;
            n && r.close(t.attr("times")),
            n = null
        })
    };
    var f = r.cache || {},
    c = function(e) {
        return f.skin ? " " + f.skin + " " + f.skin + "-" + e: ""
    };
	/**
	 * 弹出表单
	 * @params e.form 格式  
	 *			{key: '选项名[|required|=val|~=val_format]', ......}
	 *							v= 默认值
	 *							~= 显示值
	 *							o= 下拉菜单选项名 options {key:val, key: val, ......}
	 *							t= 类型 type
	 *							p= plaseholder
	 *							n= notice
	 *							required 必填
	 *							int|string|float|array|object 数据类型
	 *				OR
	 *			{
	 *				key: {			// 所有选项类型请看默认配置
						required: false,
						name: '选项名',
						type: 'radio|text|password|...',
						options: {key: val, key: val}
					}, 
	 *				key: {name: '选项名', type: 'radio|text|password|...', ......}, 
	 *				key: {name: '选项名', type: 'radio|text|password|...', ......}, 
	 *				key: {name: '选项名', type: 'radio|text|password|...', ......}, 
	 *			}
	 *
	 */
    r.form = function(e, t) {
        var a = "";
        e = e || {},
        "function" == typeof e && (t = e),
        "string" == typeof e && (e = {title: e}),
		e.area;
		
        var l;
        return r.open(i.extend({
            type: 5,
            autoClose: true,
            btn: ["&#x786E;&#x5B9A;", "&#x53D6;&#x6D88;"],
            cols: ['30%', '70%'],
            maxWidth: n.width(),
            success: function(e) {
                l = e.find(".layui-layer-input").eq(0),
                l.focus()
            },
            resize: !1,
            yes: function(i, n, f) {
                var data = f.formData();
				!data ? r.alert('请完善选项') : (t && t(data, i, l), f.config.autoClose && r.close(i));
            }
        },
        e))
    },
    r.prompt = function(e, t) {
        var a = "";
        if (e = e || {},
        "function" == typeof e && (t = e), e.area) {
            var o = e.area;
            a = 'style="width: ' + o[0] + "; height: " + o[1] + ';"',
            delete e.area
        }
        var l, s = 2 == e.formType ? '<textarea class="layui-layer-input"' + a + ">" + (e.value || "") + "</textarea>": function() {
            return '<input type="' + (1 == e.formType ? "password": "text") + '" class="layui-layer-input" value="' + (e.value || "") + '">'
        } ();
        return r.open(i.extend({
            type: 1,
            btn: ["&#x786E;&#x5B9A;", "&#x53D6;&#x6D88;"],
            content: s,
            skin: "layui-layer-prompt" + c("prompt"),
            maxWidth: n.width(),
            success: function(e) {
                l = e.find(".layui-layer-input"),
                l.focus()
            },
            resize: !1,
            yes: function(i) {
                var n = l.val();
                "" === n ? l.focus() : n.length > (e.maxlength || 500) ? r.tips("&#x6700;&#x591A;&#x8F93;&#x5165;" + (e.maxlength || 500) + "&#x4E2A;&#x5B57;&#x6570;", l, {
                    tips: 1
                }) : t && t(n, i, l)
            }
        },
        e))
    },
    r.tab = function(e) {
        e = e || {};
        var t = e.tab || {};
        return r.open(i.extend({
            type: 1,
            skin: "layui-layer-tab" + c("tab"),
            resize: !1,
            title: function() {
                var e = t.length,
                i = 1,
                n = "";
                if (e > 0) for (n = '<span class="layui-layer-tabnow">' + t[0].title + "</span>"; i < e; i++) n += "<span>" + t[i].title + "</span>";
                return n
            } (),
            content: '<ul class="layui-layer-tabmain">' +
            function() {
                var e = t.length,
                i = 1,
                n = "";
                if (e > 0) for (n = '<li class="layui-layer-tabli xubox_tab_layer">' + (t[0].content || "no content") + "</li>"; i < e; i++) n += '<li class="layui-layer-tabli">' + (t[i].content || "no  content") + "</li>";
                return n
            } () + "</ul>",
            success: function(t) {
                var n = t.find(".layui-layer-title").children(),
                a = t.find(".layui-layer-tabmain").children();
                n.on("mousedown",
                function(t) {
                    t.stopPropagation ? t.stopPropagation() : t.cancelBubble = !0;
                    var n = i(this),
                    o = n.index();
                    n.addClass("layui-layer-tabnow").siblings().removeClass("layui-layer-tabnow"),
                    a.eq(o).show().siblings().hide(),
                    "function" == typeof e.change && e.change(o)
                })
            }
        },
        e))
    },
    r.photos = function(t, n, a) {
        function o(e, t, i) {
            var n = new Image;
            return n.src = e,
            n.complete ? t(n) : (n.onload = function() {
                n.onload = null,
                t(n)
            },
            void(n.onerror = function(e) {
                n.onerror = null,
                i(e)
            }))
        }
        var l = {};
        if (t = t || {},
        t.photos) {
            var s = t.photos.constructor === Object,
            f = s ? t.photos: {},
            d = f.data || [],
            u = f.start || 0;
            if (l.imgIndex = (0 | u) + 1, t.img = t.img || "img", s) {
                if (0 === d.length) return r.msg("&#x6CA1;&#x6709;&#x56FE;&#x7247;")
            } else {
                var y = i(t.photos),
                p = function() {
                    d = [],
                    y.find(t.img).each(function(e) {
                        var t = i(this);
                        t.attr("layer-index", e),
                        d.push({
                            alt: t.attr("alt"),
                            pid: t.attr("layer-pid"),
                            src: t.attr("layer-src") || t.attr("src"),
                            thumb: t.attr("src")
                        })
                    })
                };
                if (p(), 0 === d.length) return;
                if (n || y.on("click", t.img,
                function() {
                    var e = i(this),
                    n = e.attr("layer-index");
                    r.photos(i.extend(t, {
                        photos: {
                            start: n,
                            data: d,
                            tab: t.tab
                        },
                        full: t.full
                    }), !0),
                    p()
                }), !n) return
            }
            l.imgprev = function(e) {
                l.imgIndex--,
                l.imgIndex < 1 && (l.imgIndex = d.length),
                l.tabimg(e)
            },
            l.imgnext = function(e, t) {
                l.imgIndex++,
                l.imgIndex > d.length && (l.imgIndex = 1, t) || l.tabimg(e)
            },
            l.keyup = function(e) {
                if (!l.end) {
                    var t = e.keyCode;
                    e.preventDefault(),
                    37 === t ? l.imgprev(!0) : 39 === t ? l.imgnext(!0) : 27 === t && r.close(l.index)
                }
            },
            l.tabimg = function(e) {
                d.length <= 1 || (f.start = l.imgIndex - 1, r.close(l.index), r.photos(t, !0, e))
            },
            l.event = function() {
                l.bigimg.hover(function() {
                    l.imgsee.show()
                },
                function() {
                    l.imgsee.hide()
                }),
                l.bigimg.find(".layui-layer-imgprev").on("click",
                function(e) {
                    e.preventDefault(),
                    l.imgprev()
                }),
                l.bigimg.find(".layui-layer-imgnext").on("click",
                function(e) {
                    e.preventDefault(),
                    l.imgnext()
                }),
                i(document).on("keyup", l.keyup)
            },
            l.loadi = r.load(1, {
                shade: !("shade" in t) && .9,
                scrollbar: !1
            }),
            o(d[u].src,
            function(n) {
                r.close(l.loadi),
                l.index = r.open(i.extend({
                    type: 1,
                    area: function() {
                        var a = [n.width, n.height],
                        o = [i(e).width() - 100, i(e).height() - 100];
                        if (!t.full && (a[0] > o[0] || a[1] > o[1])) {
                            var r = [a[0] / o[0], a[1] / o[1]];
                            r[0] > r[1] ? (a[0] = a[0] / r[0], a[1] = a[1] / r[0]) : r[0] < r[1] && (a[0] = a[0] / r[1], a[1] = a[1] / r[1])
                        }
                        return [a[0] + "px", a[1] + "px"]
                    } (),
                    title: !1,
                    shade: .9,
                    shadeClose: !0,
                    closeBtn: !1,
                    move: ".layui-layer-phimg img",
                    moveType: 1,
                    scrollbar: !1,
                    moveOut: !0,
                    anim: 5 * Math.random() | 0,
                    skin: "layui-layer-photos" + c("photos"),
                    content: '<div class="layui-layer-phimg"><img src="' + d[u].src + '" alt="' + (d[u].alt || "") + '" layer-pid="' + d[u].pid + '"><div class="layui-layer-imgsee">' + (d.length > 1 ? '<span class="layui-layer-imguide"><a href="javascript:;" class="layui-layer-iconext layui-layer-imgprev"></a><a href="javascript:;" class="layui-layer-iconext layui-layer-imgnext"></a></span>': "") + '<div class="layui-layer-imgbar" style="display:' + (a ? "block": "") + '"><span class="layui-layer-imgtit"><a href="javascript:;">' + (d[u].alt || "") + "</a><em>" + l.imgIndex + "/" + d.length + "</em></span></div></div></div>",
                    success: function(e, i) {
                        l.bigimg = e.find(".layui-layer-phimg"),
                        l.imgsee = e.find(".layui-layer-imguide,.layui-layer-imgbar"),
                        l.event(e),
                        t.tab && t.tab(d[u], e)
                    },
                    end: function() {
                        l.end = !0,
                        i(document).off("keyup", l.keyup)
                    }
                },
                t))
            },
            function() {
                r.close(l.loadi),
                r.msg("&#x5F53;&#x524D;&#x56FE;&#x7247;&#x5730;&#x5740;&#x5F02;&#x5E38;<br>&#x662F;&#x5426;&#x7EE7;&#x7EED;&#x67E5;&#x770B;&#x4E0B;&#x4E00;&#x5F20;&#xFF1F;", {
                    time: 3e4,
                    btn: ["&#x4E0B;&#x4E00;&#x5F20;", "&#x4E0D;&#x770B;&#x4E86;"],
                    yes: function() {
                        d.length > 1 && l.imgnext(!0, !0)
                    }
                })
            })
        }
    },
    o.run = function(t) {
        i = t,
        n = i(e),
        s.html = i("html"),
        r.open = function(e) {
            var t = new l(e);
            return t.index
        }
    },
    e.layui && layui.define ? (r.ready(), layui.define("jquery",
    function(t) {
        r.path = layui.cache.dir,
        o.run(layui.jquery),
        e.layer = r,
        t("layer", r)
    })) : "function" == typeof define ? define(["jquery"],
    function() {
        return o.run(e.jQuery),
        r
    }) : function() {
        o.run(e.jQuery),
        r.ready()
    } ()
} (window);
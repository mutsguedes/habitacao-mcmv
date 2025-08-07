/* global moment */

var yiima = (typeof yiima === "undefined" || !yiima) ? {} : yiima;
yiima.validation = (function ($) {
    var pub = {
        isEmpty: function (value) {
            return value === null || value === undefined || value === [] || value === '';
        },
        addMessage: function (messages, message, value) {
            messages.push(message.replace(/\{value\}/g, value));
        },
        isAllCharEquals: function (string) {
            var c = string.charAt(0);
            for (var i in string) {
                if (c !== string.charAt(i)) {
                    return false;
                }
            }
            return true;
        },

        datetimecompare: function (value, messages, options) {
            if (/*options.skipOnEmpty && yiima.validation.isEmpty(value)*/options.skipOnEmpty && pub.isEmpty(value)) {
                return;
            }

            var compareValue, valid = true;
            if (options.compareAttribute === undefined) {
                compareValue = options.compareValue;
            } else {
                compareValue = $('#' + options.compareAttribute).val();
            }
            //   if ((options.compareAttribute) !== ('inumados-dt_nas_inu')) {
            var dateValue = moment(value, options.format).unix();
            var dateCompareValue = moment(compareValue, options.format).unix();
            //     } else {
            //             var dateValue = moment(value, options.format).get('date');
            //             var dateCompareValue = moment(compareValue, options.format).get('date');
            //         }
            switch (options.operator) {
                case '==':
                    valid = dateValue == dateCompareValue;
                    break;
                case '===':
                    valid = value === compareValue;
                    break;
                case '!=':
                    valid = dateValue !== dateCompareValue;
                    break;
                case '!==':
                    valid = value !== compareValue;
                    break;
                case '>':
                    valid = dateValue > dateCompareValue;
                    break;
                case '>=':
                    valid = dateValue >= dateCompareValue;
                    break;
                case '<':
                    valid = dateValue < dateCompareValue;
                    break;
                case '<=':
                    valid = dateValue <= dateCompareValue;
                    break;
                default:
                    valid = false;
                    break;
            }

            if (!valid) {
                pub.addMessage(messages, options.message, value);
                //  yiima.validation.addMessage(messages, options.message, value);
            }
        },

        cpf: function (value, messages, options) {
            if (options.skipOnEmpty && pub.isEmpty(value)) {
                return;
            }
            String.prototype.repeat = function (num) {
                return new Array(isNaN(num) ? 1 : ++num).join(this);
            };
            var valid = true;
            var cpf = value.replace(/[^0-9_]/g, "");
            if (cpf.length !== 11) {
                valid = false;
            } else {
                for (var x = 0; x < 10; x++) {
                    if (cpf === x.toString().repeat(11)) {
                        valid = false;
                    }
                }
                if (valid) {
                    var c = cpf.substr(0, 9);
                    var dv = cpf.substr(9, 2);
                    var d1 = 0;
                    for (i = 0; i < 9; i++) {
                        d1 += c.charAt(i) * (10 - i);
                    }
                    if (d1 === 0) {
                        valid = false;
                    } else {
                        d1 = 11 - (d1 % 11);
                        if (d1 > 9)
                            d1 = 0;
                        if (dv.charAt(0) != d1) {
                            valid = false;
                        } else {
                            d1 *= 2;
                            for (i = 0; i < 9; i++) {
                                d1 += c.charAt(i) * (11 - i);
                            }
                            d1 = 11 - (d1 % 11);
                            if (d1 > 9)
                                d1 = 0;
                            if (dv.charAt(1) != d1) {
                                valid = false;
                            }
                        }
                    }
                }
            }
            if (!valid) {
                pub.addMessage(messages, options.message, value);
            }
        },

        nis: function (value, messages, options) {
            if (options.skipOnEmpty && pub.isEmpty(value)) {
                return;
            }
            String.prototype.repeat = function (num) {
                return new Array(isNaN(num) ? 1 : ++num).join(this);
            };

            var valid = true;
            var ftap = "3298765432";
            var total = 0;
            var i;
            var resto = 0;
            var numPIS = 0;
            var strResto = "";
            var nis = value.replace(/[^0-9_]/g, "");
            if (nis.length !== 11) {
                valid = false;
            } else {
                for (var x = 0; x < 10; x++) {
                    if (nis === x.toString().repeat(11)) {
                        valid = false;
                    }
                }
                if (valid) {
                    for (i = 0; i <= 9; i++) {
                        resultado = (nis.slice(i, i + 1)) * (ftap.slice(i, i + 1));
                        total = total + resultado;
                    }

                    resto = (total % 11);

                    if (resto != 0) {
                        resto = 11 - resto;
                    }

                    if (resto == 10 || resto == 11) {
                        strResto = resto + "";
                        resto = strResto.slice(1, 2);
                    }

                    if (resto != (nis.slice(10, 11))) {
                        valid = false;
                    }
                }
            }
            if (!valid) {
                pub.addMessage(messages, options.message, value);
            }
        },

        te: function (value, messages, options) {
            if (options.skipOnEmpty && pub.isEmpty(value)) {
                return;
            }
            String.prototype.repeat = function (num) {
                return new Array(isNaN(num) ? 1 : ++num).join(this);
            };

            var valid = true;
            var te = value.replace(/[^0-9_]/g, "");
            if (te.length !== 12) {
                valid = false;
            } else {
                for (var x = 0; x < 11; x++) {
                    if (te === x.toString().repeat(12)) {
                        valid = false;
                    }
                }
                if (valid) {
                    var dig1 = 0;
                    var dig2 = 0;
                    var tam = te.length;
                    var digitos = te.substr(tam - 2, 2);
                    var estado = te.substr(tam - 4, 2);
                    var titulo = te.substr(0, tam - 2);
                    var exce = (estado === '01') || (estado === '02');
                    dig1 = (titulo.charCodeAt(0) - 48) * 9 + (titulo.charCodeAt(1) - 48) * 8 +
                            (titulo.charCodeAt(2) - 48) * 7 + (titulo.charCodeAt(3) - 48) * 6 +
                            (titulo.charCodeAt(4) - 48) * 5 + (titulo.charCodeAt(5) - 48) * 4 +
                            (titulo.charCodeAt(6) - 48) * 3 + (titulo.charCodeAt(7) - 48) * 2;
                    var resto = (dig1 % 11);
                    if (resto === 0) {
                        if (exce) {
                            dig1 = 1;
                        } else {
                            dig1 = 0;
                        }
                    } else {
                        if (resto === 1) {
                            dig1 = 0;
                        } else {
                            dig1 = 11 - resto;
                        }
                    }

                    dig2 = (titulo.charCodeAt(8) - 48) * 4 + (titulo.charCodeAt(9) - 48) * 3 + dig1 * 2;
                    resto = (dig2 % 11);
                    if (resto === 0) {
                        if (exce) {
                            dig2 = 1;
                        } else {
                            dig2 = 0;
                        }
                    } else {
                        if (resto === 1) {
                            dig2 = 0;
                        } else {
                            dig2 = 11 - resto;
                        }
                    }

                    if (!(digitos.charCodeAt(0) - 48 === dig1) && !(digitos.charCodeAt(1) - 48 === dig2)) {
                        //return true; // Titulo valido
                        valid = false;
                    }
                }
            }
            if (!valid) {
                pub.addMessage(messages, options.message, value);
            }
        },

        cnpj: function (value, messages, options) {
            if (options.skipOnEmpty && pub.isEmpty(value)) {
                return;
            }

            String.prototype.repeat = function (num) {
                return new Array(isNaN(num) ? 1 : ++num).join(this);
            };

            var valid = true;
            var cnpj = value.replace(/[^\d]+/g, '');

            if (cnpj.length !== 14) {
                valid = false;
            } else if (pub.isAllCharEquals(cnpj)) {
                valid = false;
            } else {
                size = cnpj.length - 2;
                numbers = cnpj.substring(0, size);
                digits = cnpj.substring(size);
                sum = 0;
                pos = size - 7;
                for (i = size; i >= 1; i--) {
                    sum += numbers.charAt(size - i) * pos--;
                    if (pos < 2) {
                        pos = 9;
                    }
                }
                result = sum % 11 < 2 ? 0 : 11 - sum % 11;
                if (result != digits.charAt(0)) {
                    valid = false;
                }

                size = size + 1;
                numbers = cnpj.substring(0, size);
                sum = 0;
                pos = size - 7;
                for (i = size; i >= 1; i--) {
                    sum += numbers.charAt(size - i) * pos--;
                    if (pos < 2) {
                        pos = 9;
                    }
                }
                result = sum % 11 < 2 ? 0 : 11 - sum % 11;

                if (result != digits.charAt(1)) {
                    valid = false;
                }
            }

            if (!valid) {
                pub.addMessage(messages, options.message, value);
            }
        },
        cei: function (value, messages, options) {
            if (options.skipOnEmpty && pub.isEmpty(value)) {
                return;
            }

            var cei = value.replace(/[^0-9_]/g, '').split('');
            var valid = cei.length === 12;

            if (valid) {
                var sum = (7 * cei[0]) + (4 * cei[1]) + (1 * cei[2]) + (8 * cei[3]) + (5 * cei[4]) + (2 * cei[5]) +
                        (1 * cei[6]) + (6 * cei[7]) + (3 * cei[8]) + (7 * cei[9]) + (4 * cei[10]);

                var dv = abs(10 - (sum % 10 + sum / 10) % 10);
                valid = (cei[11] == dv);
            }

            if (!valid) {
                pub.addMessage(messages, options.message, value);
            }
        }
    };
    return pub;
})(jQuery);

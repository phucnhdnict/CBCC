/**
 * Created with JetBrains PhpStorm.
 * User: huuthanh3108
 * Date: 9/4/13
 * Time: 9:52 AM
 * To change this template use File | Settings | File Templates.
 */
angular.module('app.localeTranslation', []).value('currentLocale', {
    HELP_200: 'Sử dụng chức năng này để thiết lập tổ chức vào cây đơn vị',
    LOADING: 'Đang tải dữ liệu...',
    VALIDATION_REQUIRED: 'Bắt buộc nhập dữ liệu',
    _getLocalizationKeys: function() {
    var keys = {};
    for (var k in this) {
        keys[k] = k;
    }
    return keys;
}
});
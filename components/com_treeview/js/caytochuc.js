/**
 * Created by huuthanh3108 on 10/3/13.
 */
jQuery(document).ready(function($){

$("#tochucCaydonvi").jstree({
    // List of active plugins
    "plugins" : [
        "themes","json_data","checkbox","types"
    ],

    // I usually configure the plugin that handles the data first
    // This example uses JSON as it is most common
    "json_data" : {
        // This tree is ajax enabled - as this is most common, and maybe a bit more complex
        // All the options are almost the same as jQuery's AJAX (read the docs)

        "ajax" : {
            // the URL to fetch the data
            "url" : Core.rootUrl + "/index.php",
            // the `data` function is executed in the instance's scope
            // the parameter is the node being loaded
            // (may be -1, 0, or undefined when loading the root nodes)
            "data" : function (n) {
                // the result is fed to the AJAX request `data` option
                return {
                    "option" : "com_baocao",
                    "controller" : "treeunit",
                    "view" : "treeunit",
                    "task" : "treeunit",
                    "format" : "raw",
                    "mau" : "SN",
                    "id" : n.attr ? n.attr("id").replace("node_","") : root_id
                };
            }
        }
    },
    /*
     "checkbox": {
     two_state: true
     },
     */
    // Using types - most of the time this is an overkill

    "types" : {
        "valid_children" : [ "root" ],
        "types" : {
            "file" : {
                "icon" : {
                    "image" : Core.baseUrl + "/images/file.png"
                }
            },
            "folder" : {
                "icon" : {
                    "image" : Core.baseUrl + "/images/folder.png"
                }
            },
            "default" : {
                "valid_children" : [ "default" ]
            }
        }
    }
});
});
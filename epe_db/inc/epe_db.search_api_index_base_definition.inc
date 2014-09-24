<?php
/**
 * Since all resource types all use a similar search api index, we define default search api index definition under a common dependent module for ease of maintenance.
 */
function _epe_db_search_api_index_base_definition($name, $machine_name, $bundles=array()) {
  foreach($bundles as &$bundle) {
    $bundle = '"' . $bundle . '":"' . $bundle .  '"';
  }
  return '{
    "name" : "' . $name . '",
    "machine_name" : "' . $machine_name . '",
    "description" : null,
    "server" : "database_service",
    "item_type" : "node",
    "options" : {
      "index_directly" : 1,
      "cron_limit" : "50",
      "fields" : {
        "nid" : { "type" : "integer" },
        "type" : { "type" : "string" },
        "title" : { "type" : "string" },
        "url" : { "type" : "string" },
        "status" : { "type" : "integer" },
        "promote" : { "type" : "boolean" },
        "created" : { "type" : "date" },
        "changed" : { "type" : "date" },
        "author" : { "type" : "integer", "entity_type" : "user" },
        "field_featured_status" : { "type" : "string" },
        "field_public_status" : { "type" : "string" },
        "search_api_language" : { "type" : "string" },
        "search_api_aggregation_1" : { "type" : "text" },
        "author:uid" : { "type" : "integer" },
        "author:name" : { "type" : "string" },
        "author:mail" : { "type" : "string" },
        "author:field_account_fname" : { "type" : "string" },
        "author:field_account_lname" : { "type" : "string" },
        "author:field_account_organization" : { "type" : "text" },
        "body:value" : { "type" : "text" },
        "body:summary" : { "type" : "text" }
      },
      "data_alter_callbacks" : {
        "search_api_alter_bundle_filter" : {
          "status" : 1,
          "weight" : "-10",
          "settings" : { "default" : "0", "bundles" : { ' . implode(',', $bundles) . ' } }
        },
        "search_api_alter_node_access" : { "status" : 0, "weight" : "0", "settings" : [] },
        "search_api_alter_node_status" : { "status" : 0, "weight" : "0", "settings" : [] },
        "search_api_alter_add_hierarchy" : { "status" : 0, "weight" : "0", "settings" : { "fields" : [] } },
        "search_api_alter_add_viewed_entity" : { "status" : 0, "weight" : "0", "settings" : { "mode" : "full" } },
        "search_api_alter_add_url" : { "status" : 0, "weight" : "0", "settings" : [] },
        "search_api_alter_add_aggregation" : {
          "status" : 1,
          "weight" : "0",
          "settings" : { "fields" : { "search_api_aggregation_1" : {
                "name" : "title_main_body_fulltext_search",
                "type" : "fulltext",
                "fields" : [ "title", "body:value" ],
                "description" : "A Fulltext aggregation of the following fields: Title, The main body text \\u00bb Text."
              }
            }
          }
        }
      },
      "processors" : {
        "search_api_case_ignore" : {
          "status" : 1,
          "weight" : "0",
          "settings" : { "fields" : {
              "title" : true,
              "search_api_aggregation_1" : true,
              "author:name" : true,
              "author:field_account_fname" : true,
              "author:field_account_lname" : true,
              "body:value" : true
            }
          }
        },
        "search_api_html_filter" : {
          "status" : 1,
          "weight" : "10",
          "settings" : {
            "fields" : { "title" : true, "search_api_aggregation_1" : true, "body:value" : true },
            "title" : 0,
            "alt" : 1,
            "tags" : "h1 = 5\\r\\nh2 = 3\\r\\nh3 = 2\\r\\nstrong = 2\\r\\nb = 2\\r\\nem = 1.5\\r\\nu = 1.5"
          }
        },
        "search_api_tokenizer" : {
          "status" : 1,
          "weight" : "20",
          "settings" : {
            "fields" : { "search_api_aggregation_1" : true, "body:value" : true },
            "spaces" : "[^[:alnum:]]",
            "ignorable" : "[\\u0027]"
          }
        },
        "search_api_stopwords" : {
          "status" : 0,
          "weight" : "30",
          "settings" : {
            "fields" : {
              "author:name" : true,
              "author:field_account_fname" : true,
              "author:field_account_lname" : true,
              "body:value" : true
            },
            "file" : "",
            "stopwords" : "but\\r\\ndid\\r\\nthe this that those\\r\\netc"
          }
        },
        "search_api_highlighting" : {
          "status" : 0,
          "weight" : "35",
          "settings" : {
            "prefix" : "\\u003Cstrong\\u003E",
            "suffix" : "\\u003C\\/strong\\u003E",
            "excerpt" : 1,
            "excerpt_length" : "256",
            "highlight" : "always"
          }
        }
      }
    },
    "enabled" : "1",
    "read_only" : "0",
    "rdf_mapping" : []
  }';
}

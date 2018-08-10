
INSERT INTO `api` (`id`, `title`, `description`, `url`, `formats`, `http_method`, `parameters`, `prerequisites`, `notes`, `sample_request`, `sample_response`, `error_response`, `position`) VALUES
(1, 'REST API - Add Records', 'where,\r\n\r\nThis is the admin username which can be obtained using zoho.adminuser or zoho.appuri variables (refer this page). You can also view your app URL in the URL bar of your browser for example, &lt;https://creator.zoho.com/&lt;ownername&gt;/&lt;applicationname&gt;/...> to obtain it.', 'https://creator.zoho.com/api/<ownername>/<format>/<applicationName>/form/<formName>/record/add', 'json', 'POST', '<table class="table table-striped table-bordered detail-view">\r\n<tr><th>Parameter Name</th><th>Usage</th><th>Description</th></tr>\r\n<tr><td>authtoken</td><td>Required</td><td>A valid API authtoken. Refer this page to generate authtoken.\r\n</td></tr>\r\n<tr><td></td><td></td><td></td></tr>\r\n</table>', '<ul><li>A valid AuthToken</li></ul> ', '<ul><li>You can add only one record in one form at a time.</li><li>Multiple picklist values must be separated by a comma.</li><li>Only the owner of the application can add a record to a private Form.</li><li>Anyone with a valid authtoken can add a record to a public Form.</li><li>Any user with a valid authtoken and share permission can add a record to a shared Form.</li><li>Mandatory form fields cannot be left blank in the add request.</li><li>The record ID of the new entry is returned along with the field values passed in the request.</li></ul>', '<form method="POST" action="https://creator.zoho.com/api/sampleapps/xml/sample/form/Employee/record/add">\r\n<input type="hidden" name ="authtoken" value="***************">\r\n<input type="hidden" name ="scope" id="scope" value="creatorapi">\r\n<input type="text" name="Name" value="Gary">\r\n<input type="text" name="DOB" value="12-Jun-1980">\r\n<input type="text" name="Address" value="USA">\r\n<input type="text" name="Basic" value="10000">\r\n<input type="text" name="Hobbies" value="Reading,Writing">\r\n\r\n<input type="submit" value="Add Record">\r\n</form>', '{  \r\n   {  \r\n      "formname":[  \r\n         "RestAPI",\r\n         {  \r\n            "operation":[  \r\n               "add",\r\n               {  \r\n                  "values":{  \r\n                     "Name":"Gary",\r\n                     "Basic":"10000",\r\n                     "Hobbies":[  \r\n                        "Reading",\r\n                        "Writing"\r\n                     ],\r\n                     "DOB":"12-Jun-1980",\r\n                     "Address":"USA",\r\n                     "ID":89597000010897007\r\n                  },\r\n                  "status":"Success"\r\n               }\r\n            ]\r\n         }\r\n      ]\r\n   }', '', 150),
(2, 'REST API - UPDATE Records', 'where,\r\n\r\nThis is the admin username which can be obtained using zoho.adminuser or zoho.appuri variables (refer this page). You can also view your app URL in the URL bar of your browser for example, &lt;https://creator.zoho.com/&lt;ownername&gt;/&lt;applicationname&gt;/...> to obtain it.', 'https://creator.zoho.com/api/<ownername>/<format>/<applicationName>/form/<formName>/record/add', 'json', 'POST', '<table class="table table-striped table-bordered detail-view">\r\n<tr><th>Parameter Name</th><th>Usage</th><th>Description</th></tr>\r\n<tr><td>authtoken</td><td>Required</td><td>A valid API authtoken. Refer this page to generate authtoken.\r\n</td></tr>\r\n<tr><td></td><td></td><td></td></tr>\r\n</table>', '<ul><li>A valid AuthToken</li></ul> ', '<ul><li>You can add only one record in one form at a time.</li><li>Multiple picklist values must be separated by a comma.</li><li>Only the owner of the application can add a record to a private Form.</li><li>Anyone with a valid authtoken can add a record to a public Form.</li><li>Any user with a valid authtoken and share permission can add a record to a shared Form.</li><li>Mandatory form fields cannot be left blank in the add request.</li><li>The record ID of the new entry is returned along with the field values passed in the request.</li></ul>', '<form method="POST" action="https://creator.zoho.com/api/sampleapps/xml/sample/form/Employee/record/add">\r\n<input type="hidden" name ="authtoken" value="***************">\r\n<input type="hidden" name ="scope" id="scope" value="creatorapi">\r\n<input type="text" name="Name" value="Gary">\r\n<input type="text" name="DOB" value="12-Jun-1980">\r\n<input type="text" name="Address" value="USA">\r\n<input type="text" name="Basic" value="10000">\r\n<input type="text" name="Hobbies" value="Reading,Writing">\r\n\r\n<input type="submit" value="Add Record">\r\n</form>', '{  \r\n   {  \r\n      "formname":[  \r\n         "RestAPI",\r\n         {  \r\n            "operation":[  \r\n               "add",\r\n               {  \r\n                  "values":{  \r\n                     "Name":"Gary",\r\n                     "Basic":"10000",\r\n                     "Hobbies":[  \r\n                        "Reading",\r\n                        "Writing"\r\n                     ],\r\n                     "DOB":"12-Jun-1980",\r\n                     "Address":"USA",\r\n                     "ID":89597000010897007\r\n                  },\r\n                  "status":"Success"\r\n               }\r\n            ]\r\n         }\r\n      ]\r\n   }', '', 150),
(3, 'REST API - ADD User', 'where,\r\n\r\nThis is the admin username which can be obtained using zoho.adminuser or zoho.appuri variables (refer this page). You can also view your app URL in the URL bar of your browser for example, &lt;https://creator.zoho.com/&lt;ownername&gt;/&lt;applicationname&gt;/...> to obtain it.', 'https://creator.zoho.com/api/<ownername>/<format>/<applicationName>/form/<formName>/record/add', 'json', 'POST', '<table class="table table-striped table-bordered detail-view">\r\n<tr><th>Parameter Name</th><th>Usage</th><th>Description</th></tr>\r\n<tr><td>authtoken</td><td>Required</td><td>A valid API authtoken. Refer this page to generate authtoken.\r\n</td></tr>\r\n<tr><td></td><td></td><td></td></tr>\r\n</table>', '<ul><li>A valid AuthToken</li></ul> ', '<ul><li>You can add only one record in one form at a time.</li><li>Multiple picklist values must be separated by a comma.</li><li>Only the owner of the application can add a record to a private Form.</li><li>Anyone with a valid authtoken can add a record to a public Form.</li><li>Any user with a valid authtoken and share permission can add a record to a shared Form.</li><li>Mandatory form fields cannot be left blank in the add request.</li><li>The record ID of the new entry is returned along with the field values passed in the request.</li></ul>', '<form method="POST" action="https://creator.zoho.com/api/sampleapps/xml/sample/form/Employee/record/add">\r\n<input type="hidden" name ="authtoken" value="***************">\r\n<input type="hidden" name ="scope" id="scope" value="creatorapi">\r\n<input type="text" name="Name" value="Gary">\r\n<input type="text" name="DOB" value="12-Jun-1980">\r\n<input type="text" name="Address" value="USA">\r\n<input type="text" name="Basic" value="10000">\r\n<input type="text" name="Hobbies" value="Reading,Writing">\r\n\r\n<input type="submit" value="Add Record">\r\n</form>', '{  \r\n   {  \r\n      "formname":[  \r\n         "RestAPI",\r\n         {  \r\n            "operation":[  \r\n               "add",\r\n               {  \r\n                  "values":{  \r\n                     "Name":"Gary",\r\n                     "Basic":"10000",\r\n                     "Hobbies":[  \r\n                        "Reading",\r\n                        "Writing"\r\n                     ],\r\n                     "DOB":"12-Jun-1980",\r\n                     "Address":"USA",\r\n                     "ID":89597000010897007\r\n                  },\r\n                  "status":"Success"\r\n               }\r\n            ]\r\n         }\r\n      ]\r\n   }', '', 150),
(4, 'REST API - DELETE User', 'where,\r\n\r\nThis is the admin username which can be obtained using zoho.adminuser or zoho.appuri variables (refer this page). You can also view your app URL in the URL bar of your browser for example, &lt;https://creator.zoho.com/&lt;ownername&gt;/&lt;applicationname&gt;/...> to obtain it.', 'https://creator.zoho.com/api/<ownername>/<format>/<applicationName>/form/<formName>/record/add', 'json', 'POST', '<table class="table table-striped table-bordered detail-view">\r\n<tr><th>Parameter Name</th><th>Usage</th><th>Description</th></tr>\r\n<tr><td>authtoken</td><td>Required</td><td>A valid API authtoken. Refer this page to generate authtoken.\r\n</td></tr>\r\n<tr><td></td><td></td><td></td></tr>\r\n</table>', '<ul><li>A valid AuthToken</li></ul> ', '<ul><li>You can add only one record in one form at a time.</li><li>Multiple picklist values must be separated by a comma.</li><li>Only the owner of the application can add a record to a private Form.</li><li>Anyone with a valid authtoken can add a record to a public Form.</li><li>Any user with a valid authtoken and share permission can add a record to a shared Form.</li><li>Mandatory form fields cannot be left blank in the add request.</li><li>The record ID of the new entry is returned along with the field values passed in the request.</li></ul>', '<form method="POST" action="https://creator.zoho.com/api/sampleapps/xml/sample/form/Employee/record/add">\r\n<input type="hidden" name ="authtoken" value="***************">\r\n<input type="hidden" name ="scope" id="scope" value="creatorapi">\r\n<input type="text" name="Name" value="Gary">\r\n<input type="text" name="DOB" value="12-Jun-1980">\r\n<input type="text" name="Address" value="USA">\r\n<input type="text" name="Basic" value="10000">\r\n<input type="text" name="Hobbies" value="Reading,Writing">\r\n\r\n<input type="submit" value="Add Record">\r\n</form>', '{  \r\n   {  \r\n      "formname":[  \r\n         "RestAPI",\r\n         {  \r\n            "operation":[  \r\n               "add",\r\n               {  \r\n                  "values":{  \r\n                     "Name":"Gary",\r\n                     "Basic":"10000",\r\n                     "Hobbies":[  \r\n                        "Reading",\r\n                        "Writing"\r\n                     ],\r\n                     "DOB":"12-Jun-1980",\r\n                     "Address":"USA",\r\n                     "ID":89597000010897007\r\n                  },\r\n                  "status":"Success"\r\n               }\r\n            ]\r\n         }\r\n      ]\r\n   }', '', 150),
(5, 'REST API - Add Address', 'where,\r\n\r\nThis is the admin username which can be obtained using zoho.adminuser or zoho.appuri variables (refer this page). You can also view your app URL in the URL bar of your browser for example, &lt;https://creator.zoho.com/&lt;ownername&gt;/&lt;applicationname&gt;/...> to obtain it.', 'https://creator.zoho.com/api/<ownername>/<format>/<applicationName>/form/<formName>/record/add', 'json', 'POST', '<table class="table table-striped table-bordered detail-view">\r\n<tr><th>Parameter Name</th><th>Usage</th><th>Description</th></tr>\r\n<tr><td>authtoken</td><td>Required</td><td>A valid API authtoken. Refer this page to generate authtoken.\r\n</td></tr>\r\n<tr><td></td><td></td><td></td></tr>\r\n</table>', '<ul><li>A valid AuthToken</li></ul> ', '<ul><li>You can add only one record in one form at a time.</li><li>Multiple picklist values must be separated by a comma.</li><li>Only the owner of the application can add a record to a private Form.</li><li>Anyone with a valid authtoken can add a record to a public Form.</li><li>Any user with a valid authtoken and share permission can add a record to a shared Form.</li><li>Mandatory form fields cannot be left blank in the add request.</li><li>The record ID of the new entry is returned along with the field values passed in the request.</li></ul>', '<form method="POST" action="https://creator.zoho.com/api/sampleapps/xml/sample/form/Employee/record/add">\r\n<input type="hidden" name ="authtoken" value="***************">\r\n<input type="hidden" name ="scope" id="scope" value="creatorapi">\r\n<input type="text" name="Name" value="Gary">\r\n<input type="text" name="DOB" value="12-Jun-1980">\r\n<input type="text" name="Address" value="USA">\r\n<input type="text" name="Basic" value="10000">\r\n<input type="text" name="Hobbies" value="Reading,Writing">\r\n\r\n<input type="submit" value="Add Record">\r\n</form>', '{  \r\n   {  \r\n      "formname":[  \r\n         "RestAPI",\r\n         {  \r\n            "operation":[  \r\n               "add",\r\n               {  \r\n                  "values":{  \r\n                     "Name":"Gary",\r\n                     "Basic":"10000",\r\n                     "Hobbies":[  \r\n                        "Reading",\r\n                        "Writing"\r\n                     ],\r\n                     "DOB":"12-Jun-1980",\r\n                     "Address":"USA",\r\n                     "ID":89597000010897007\r\n                  },\r\n                  "status":"Success"\r\n               }\r\n            ]\r\n         }\r\n      ]\r\n   }', '', 150),
(6, 'REST API - Delete Address', 'where,\r\n\r\nThis is the admin username which can be obtained using zoho.adminuser or zoho.appuri variables (refer this page). You can also view your app URL in the URL bar of your browser for example, &lt;https://creator.zoho.com/&lt;ownername&gt;/&lt;applicationname&gt;/...> to obtain it.', 'https://creator.zoho.com/api/<ownername>/<format>/<applicationName>/form/<formName>/record/add', 'json', 'POST', '<table class="table table-striped table-bordered detail-view">\r\n<tr><th>Parameter Name</th><th>Usage</th><th>Description</th></tr>\r\n<tr><td>authtoken</td><td>Required</td><td>A valid API authtoken. Refer this page to generate authtoken.\r\n</td></tr>\r\n<tr><td></td><td></td><td></td></tr>\r\n</table>', '<ul><li>A valid AuthToken</li></ul> ', '<ul><li>You can add only one record in one form at a time.</li><li>Multiple picklist values must be separated by a comma.</li><li>Only the owner of the application can add a record to a private Form.</li><li>Anyone with a valid authtoken can add a record to a public Form.</li><li>Any user with a valid authtoken and share permission can add a record to a shared Form.</li><li>Mandatory form fields cannot be left blank in the add request.</li><li>The record ID of the new entry is returned along with the field values passed in the request.</li></ul>', '<form method="POST" action="https://creator.zoho.com/api/sampleapps/xml/sample/form/Employee/record/add">\r\n<input type="hidden" name ="authtoken" value="***************">\r\n<input type="hidden" name ="scope" id="scope" value="creatorapi">\r\n<input type="text" name="Name" value="Gary">\r\n<input type="text" name="DOB" value="12-Jun-1980">\r\n<input type="text" name="Address" value="USA">\r\n<input type="text" name="Basic" value="10000">\r\n<input type="text" name="Hobbies" value="Reading,Writing">\r\n\r\n<input type="submit" value="Add Record">\r\n</form>', '{  \r\n   {  \r\n      "formname":[  \r\n         "RestAPI",\r\n         {  \r\n            "operation":[  \r\n               "add",\r\n               {  \r\n                  "values":{  \r\n                     "Name":"Gary",\r\n                     "Basic":"10000",\r\n                     "Hobbies":[  \r\n                        "Reading",\r\n                        "Writing"\r\n                     ],\r\n                     "DOB":"12-Jun-1980",\r\n                     "Address":"USA",\r\n                     "ID":89597000010897007\r\n                  },\r\n                  "status":"Success"\r\n               }\r\n            ]\r\n         }\r\n      ]\r\n   }', '', 0);
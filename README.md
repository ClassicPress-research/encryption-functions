### ClassicPress Encryption
ClassicPress EXPERIMENTAL plugin: Post meta fields encryption and decryption for GDPR and privacy laws compliance.<br />
<strong>Note:</strong> This plugin does not work with the Gutenberg editor.

## Instructions
1. Define <em>CP_PASS_PHRASE</em> constant in wp-config.php file as a <em>passphrase</em> string or <em>Key-Encryption-Key (KEK)</em> API URL.<br />
Example:<br />
define('CP_PASS_PHRASE', 'SecretPassPhrase12345'); // Passphrase<br />
define('CP_PASS_PHRASE', 'http://localhost/api/encryption/encryption.php'); // KEK API URL<br />
2. Install and activate <em>ClassicPress Encryption</em> plugin.<br />
3. In the post/CPT administrative area, check the <em>Custom Fields</em> checkbox in the <em>Screen Options</em> section.<br />
4. The <em>Encrypt</em> and <em>Decrypt</em> buttons will appear at the right-hand side of the <em>Publish</em> or <em>Update</em> buttons. Add the custom field first, then press the encrypt button to encrypt the custom field value.<br />
5. For existing post meta fields, pressing the <em>Encrypt</em> button will encrypt the post meta fields without the prefix 'encv'. Pressing the <em>Decrypt</em> button will decrypt the encrypted meta values, but will return the same meta value if the prefix 'encv' is not present.<br />
6. To manually encrypt or decrypt data, such as when storing or displaying custom fields, use the <em>BasicPHP</em> methods <em>encrypt</em> and <em>decrypt</em>.<br />
Example:<br />
Basic::encrypt($plaintext, CP_PASS_PHRASE); // Encrypt data<br />
Basic::decrypt($encrypted, CP_PASS_PHRASE); // Decrypt data

## Features
1. Advanced Encryption Standard (AES) - GCM, or CTR/CBC Mode with 256-bit key
2. Passphrase or Key-Encryption-Key (KEK) API URL for decoupling encryption keys
3. Keyed-Hash Message Authentication Code (HMAC) for authentication - SHA256
4. Password-Based Key Derivation using a secret passphrase - SHA256 with 10,000 iterations
5. Encryption versioning for backward compatibility - 'enc' prefix, concatenated with 'v1' for versioning

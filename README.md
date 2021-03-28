### ClassicPress Encryption
ClassicPress EXPERIMENTAL plugin: Post meta fields encryption and decryption for GDPR and privacy laws compliance.

## Instructions
1. Define <em>CP_PASS_PHRASE</em> constant in wp-config.php file.<br />
Example:<br />
define('CP_PASS_PHRASE', 'SecretPassPhrase12345');<br />
2. Install and activate <em>ClassicPress Encryption</em> plugin.<br />
3. Check the <em>Custom Fields</em> checkbox in the <em>Screen Options</em> section.<br />
4. In the post/CPT administrative area, the <em>Encrypt</em> and <em>Decrypt</em> buttons will appear at the right-hand side of the <em>Publish</em> or <em>Update</em> buttons. Add the custom field first, then press the encrypt button to encrypt the custom field value.<br />
5. For existing post meta fields, pressing the <em>Encrypt</em> button will encrypt the post meta fields. Pressing the <em>Decrypt</em> button will decrypt encrypted meta values, but will return the same meta value if the prefix 'encv' is not present.

## Features
1. Advanced Encryption Standard (AES) - GCM, or CTR/CBC Mode with 256-bit key
2. Keyed-Hash Message Authentication Code (HMAC) for authentication - SHA256
3. Password-Based Key Derivation using a secret passphrase - SHA256 with 10,000 iterations
4. Encryption versioning for backward compatibility - 'enc' prefix, concatenated with 'v1' for versioning

## ClassicPress Encryption
ClassicPress EXPERIMENTAL plugin: Functions for developers to use to encrypt data at-rest.

### Instructions
1. Define CP_PASS_PHRASE constant in wp-config.php file.<br />
Example:<br />
define('CP_PASS_PHRASE', 'Secret PassPhrase');<br />
2. Use cp_encrypt( ) function to encrypt data.<br />
Example:<br />
add_metadata( 'post', $pid, 'name', cp_encrypt( $name ) );<br />
3. Use cp_decrypt( ) function to decrypt data.<br />
Example:<br />
echo cp_decrypt( $encrypted_name );<br />

### Features
1. Advanced Encryption Standard (AES) - CBC Mode
2. Keyed-Hash Message Authentication Code (HMAC) for authentication
3. Key derivation using a passphrase

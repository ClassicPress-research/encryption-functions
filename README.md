## ClassicPress Encryption
ClassicPress EXPERIMENTAL plugin: Encryption functions to encrypt and decrypt data for GDPR and privacy laws compliance.

### Instructions
1. Define CP_PASS_PHRASE constant in wp-config.php file.<br />
Example:<br />
define('CP_PASS_PHRASE', 'SecretPassPhrase12345');<br />
2. Use cp_encrypt( ) function to encrypt data.<br />
Example:<br />
$name = 'plaintext';<br />
add_metadata( 'post', $pid, 'name', cp_encrypt( $name ) );<br />
3. Use cp_decrypt( ) function to decrypt data.<br />
Example:<br />
$encrypted_name = 'enc-v1::RVNIWlBpL2VueDAzNUFzdnJ2ZzhaQT09::MDk1Y2NkZWMzYTVjMDlmNjg3ZTk4YWE1MDk5MzI2NzNlN2FmODczZWYzYzNjOTRkYjZkNzk5MDkwM2YxYTI5MQ==::5oJ5xSt66wy2i7qI73OXsg==::3C8e5/PyEGhYDk+vgn0U7w==::kYScP8LQvpc5VBnyPTVJ8g=='<br />
echo cp_decrypt( $encrypted_name );<br />

### Features
1. Advanced Encryption Standard (AES) - CBC Mode with 256-bit key
2. Keyed-Hash Message Authentication Code (HMAC) for authentication
3. Password-Based Key Derivation using a secret passphrase
4. Encryption versioning for backward compatibility

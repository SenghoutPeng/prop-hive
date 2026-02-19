<form method="POST" action="/contact-us">
  @csrf
  <input type="text" name="name" value="Test User" required>
  <input type="email" name="email" value="test@example.com" required>
  <textarea name="message" required>Test message</textarea>
  <button type="submit">Send</button>
</form> 
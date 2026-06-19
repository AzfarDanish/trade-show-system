<h1>Edit Lead</h1>

<form method="POST" action="/exhibitor/leads/update/{{ $lead->lead_id }}">
    @csrf
    @method('PUT')

    <input type="text" name="lead_name" value="{{ $lead->lead_name }}">

    <input type="text" name="company_name" value="{{ $lead->company_name }}">

    <input type="text" name="phone" value="{{ $lead->phone }}">

    <input type="email" name="email" value="{{ $lead->email }}">

    <textarea name="notes">{{ $lead->notes }}</textarea>

    <button type="submit">Update Lead</button>
</form>
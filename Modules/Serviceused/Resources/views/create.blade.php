<div class="modal fade" id="createServiceused" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Serviceused</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('serviceused.store') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="proposal_id" class="form-label">Proposal Number</label>
                        <select class="form-select" id="proposal_id" name="proposal_id" required>
                            <option value="" disabled selected>Pilih Proposal Number</option>
                            @foreach($proposalList as $proposal)
                                <option value="{{ $proposal->id }}">{{ $proposal->number }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="service_name" class="form-label ">Nama Service</label>
                        <input type="text" class="form-control" id="service_name" name="service_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="pending">Pending</option>
                            <option value="ongoing">Ongoing</option>
                            <option value="done">Done</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Serviceused</button>
                </div>

            </form>
        </div>
    </div>
</div>

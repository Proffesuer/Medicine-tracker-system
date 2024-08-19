
    <br><br>
<!-- Button trigger modal -->
  <div class="container mt-5">
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal">
            Add New Review
        </button>

        <!-- The Modal -->
        <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="reviewModalLabel">New Review</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal Body with Form -->
                    <div class="modal-body">
                        <form action="submit_review.php" method="post">
                            <div class="mb-3">
                                <label for="reviewer_name" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="reviewer_name" name="reviewer_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="review_content" class="form-label">Review</label>
                                <textarea class="form-control" id="review_content" name="review_content" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="review_rating" class="form-label">Rating</label>
                                <select class="form-select" id="review_rating" name="review_rating" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="1">1 - Very Poor</option>
                                    <option value="2">2 - Poor</option>
                                    <option value="3">3 - Average</option>
                                    <option value="4">4 - Good</option>
                                    <option value="5">5 - Excellent</option>
                                </select>
                            </div>
                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit Review</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->

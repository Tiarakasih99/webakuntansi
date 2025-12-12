<footer class="footer">
    <div class="container text-center">
        <small>&copy; {{ date('Y') }} Adésté & Co. All Rights Reserved.</small>
    </div>
</footer>

<style>
.footer {
    margin-left: 260px;
    margin-right: 25px;
    margin-bottom: 25px;
    width: calc(100% - 285px);
    padding: 15px 0;
    font-size: 1rem;
    font-weight: 500;
    color: #F3F6FF;
    border-radius: 25px;

    /* Glassmorphism */
    background: rgba(255, 255, 255, 0.1); /* transparan */
    backdrop-filter: blur(10px); /* blur background */
    -webkit-backdrop-filter: blur(10px); /* untuk Safari */
    border: 1px solid rgba(255, 255, 255, 0.3); /* border halus */
}

.footer a {
    color: #FFC107;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer a:hover {
    color: #FFF176;
}
</style>
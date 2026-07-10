<?php
$ci = &get_instance();
$txnid = $_POST['txnid'] ?? $_GET['txnid'] ?? '';
$amount = $_POST['amount'] ?? $_GET['amount'] ?? '';
$mihpayid = $_POST['mihpayid'] ?? $_GET['mihpayid'] ?? '';

if (!empty($txnid)) {
    $ci->db->where('txn_id', $txnid)->update('ab_payment_data', ['status' => 'success']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #1e1e2f 0%, #151522 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #fff;
        }
        .status-card {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px;
            max-width: 480px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }
        .icon-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(16, 185, 129, 0.15);
            color: #10b981;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            margin: 0 auto 24px;
            border: 2px solid rgba(16, 185, 129, 0.3);
        }
        h1 {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #34d399;
        }
        p.subtitle {
            color: #a1a1aa;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 24px;
        }
        .details-box {
            background: rgba(0, 0, 0, 0.25);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 28px;
            text-align: left;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 14px;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            color: #9ca3af;
        }
        .detail-value {
            font-weight: 600;
            color: #e5e7eb;
        }
        .btn-group {
            display: flex;
            gap: 12px;
            justify-content: center;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.25s ease;
            cursor: pointer;
            border: none;
        }
        .btn-primary {
            background: #10b981;
            color: #fff;
        }
        .btn-primary:hover {
            background: #059669;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(16, 185, 129, 0.3);
        }
    </style>
</head>
<body>
    <div class="status-card">
        <div class="icon-circle">
            <i class="fas fa-check"></i>
        </div>
        <h1>Payment Successful!</h1>
        <p class="subtitle">Thank you for your payment. Your transaction has been processed successfully.</p>

        <?php if (!empty($txnid)): ?>
        <div class="details-box">
            <div class="detail-row">
                <span class="detail-label">Transaction ID</span>
                <span class="detail-value"><?php echo htmlspecialchars($txnid); ?></span>
            </div>
            <?php if (!empty($mihpayid)): ?>
            <div class="detail-row">
                <span class="detail-label">Payment ID</span>
                <span class="detail-value"><?php echo htmlspecialchars($mihpayid); ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($amount)): ?>
            <div class="detail-row">
                <span class="detail-label">Amount Paid</span>
                <span class="detail-value">₹<?php echo htmlspecialchars($amount); ?></span>
            </div>
            <?php endif; ?>
            <div class="detail-row">
                <span class="detail-label">Status</span>
                <span class="detail-value" style="color: #10b981;">Success</span>
            </div>
        </div>
        <?php endif; ?>

        <div class="btn-group">
            <a href="<?php echo base_url(); ?>" class="btn btn-primary"><i class="fas fa-home"></i> Return to Homepage</a>
        </div>
    </div>
</body>
</html>

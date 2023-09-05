<?php
namespace Droxic\Affiliate\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class AffiliateId extends Column
{
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['affiliate_id'])) {
                    // Modify the display value if needed
                    $item['affiliate_id'] = ( $item['affiliate_id']) ? "yes" : "no";










                    // i dont know















                }
            }
        }
        return $dataSource;
    }
}

<?php

    declare(strict_types=1);

    namespace  Droxic\InsuranceClaimForm\Model\Resolver;

    use Magento\Framework\GraphQl\Exception\GraphQlInputException;
    use Magento\Framework\GraphQl\Config\Element\Field;
    use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
    use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
    use Magento\Framework\GraphQl\Query\ResolverInterface;
    use Droxic\InsuranceClaimForm\Model\ResourceModel\Claim\CollectionFactory;
    use Droxic\InsuranceClaimForm\Model\Claim;
    
    class GetClaimStatus implements ResolverInterface
    {
       protected $collection;
       public function __construct(
            CollectionFactory $collectionFactory
        ) {
            $this->collection = $collectionFactory;
        }
       public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
        {
            $firstname = $args['firstname'];
            $lastname = $args['lastname'];
            $insuranceId = $args['insuranceId'];

            $claimModel = $this->collection->create()->loadByFirstnameLastnameInsuranceId($firstname, $lastname, $insuranceId);
  
            if (!empty($claimModel['claim_status'])) {
                return [
                        'status' => Claim::STATUSES[
                            $claimModel['claim_status']
                        ]
                    ];
            } else {
                return ['status' => 'Record not found'];
            }

            
            //$this->collection->create();
            // filter by firstname lastname ins Id
            // get one or first record
            // return status from this record

            // if there is no record return default text

            //var_dump($args['firstname']);
            //die;
            //return ["status" => "non existing"];

            // 1 Received
            // 2 Proccesssing
            // 3 Declined
            // 4 Approved
            // 5 Finished

        }
       
    }